@extends('layouts.app')

@section('title', 'Tugas Pembelajaran - Siswa')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-0 text-dark">Daftar Tugas Pembelajaran</h2>
        <p class="text-muted">Pantau status pengerjaan dan kumpulkan tugas dasar pemrograman Anda di bawah ini</p>
    </div>
</div>

@if($tugas->isEmpty())
    <div class="card shadow-sm border-0">
        <div class="card-body py-5 text-center">
            <div class="text-muted fs-1 mb-3">📖</div>
            <h5 class="fw-bold">Belum ada tugas pembelajaran</h5>
            <p class="text-muted mb-0">Guru belum mengunggah tugas pembelajaran untuk saat ini.</p>
        </div>
    </div>
@else
    <div class="row">
        @foreach($tugas as $item)
            @php
                $isSubmitted = in_array($item->id_tugas, $sudahDikumpulIds);
            @endphp
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm border-0 h-100 d-flex flex-column">
                    <div class="card-body p-4 flex-grow-1">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-secondary">Tugas</span>
                            @if($isSubmitted)
                                <span class="badge bg-success">✔️ Sudah Dikumpulkan</span>
                            @else
                                <span class="badge bg-warning text-dark">⏳ Belum Dikumpulkan</span>
                            @endif
                        </div>
                        <h4 class="fw-bold text-dark mb-2">{{ $item->nama_tugas }}</h4>
                        <p class="text-muted mb-3 small">
                            📖 Materi: <strong>{{ $item->materi->judul ?? '-' }}</strong> <br>
                            👤 Guru: <strong>{{ $item->materi->guru->nama ?? 'Guru' }}</strong>
                        </p>
                        <p class="card-text text-secondary mb-0">
                            {{ Str::limit($item->deskripsi, 100) }}
                        </p>
                    </div>
                    <div class="card-footer bg-white border-0 px-4 pb-4 pt-0">
                        <a href="{{ route('siswa.tugas.show', $item->id_tugas) }}" class="btn btn-outline-primary w-100 fw-medium">
                            Lihat & Kumpulkan &rarr;
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
