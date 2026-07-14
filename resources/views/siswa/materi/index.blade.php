@extends('layouts.app')

@section('title', 'Materi Pembelajaran - Siswa')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-0 text-dark">Daftar Materi Pembelajaran</h2>
        <p class="text-muted">Akses semua materi ajar pemrograman dasar yang disediakan oleh Guru</p>
    </div>
</div>

@if($materi->isEmpty())
    <div class="card shadow-sm border-0">
        <div class="card-body py-5 text-center">
            <div class="text-muted fs-1 mb-3">📖</div>
            <h5 class="fw-bold">Belum ada materi pembelajaran</h5>
            <p class="text-muted mb-0">Guru belum mengunggah materi pembelajaran untuk saat ini.</p>
        </div>
    </div>
@else
    <div class="row">
        @foreach($materi as $item)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm border-0 h-100 d-flex flex-column">
                    <div class="card-body p-4 flex-grow-1">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-primary">Materi</span>
                            @if($item->file_materi)
                                <span class="badge bg-success small">📄 File</span>
                            @endif
                        </div>
                        <h4 class="fw-bold text-dark mb-2">{{ $item->judul }}</h4>
                        <p class="text-muted mb-3 small">
                            👤 Oleh: <strong>{{ $item->guru->nama ?? 'Guru' }}</strong> <br>
                            📅 Upload: {{ $item->tgl_upload ? \Carbon\Carbon::parse($item->tgl_upload)->format('d M Y') : '-' }}
                        </p>
                        <p class="card-text text-secondary mb-0">
                            {{ Str::limit($item->isi_materi, 120) }}
                        </p>
                    </div>
                    <div class="card-footer bg-white border-0 px-4 pb-4 pt-0">
                        <a href="{{ route('siswa.materi.show', $item->id_materi) }}" class="btn btn-outline-primary w-100 fw-medium">
                            Baca Materi &rarr;
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
