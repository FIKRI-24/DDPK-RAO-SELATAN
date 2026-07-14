@extends('layouts.app')

@section('title', 'Kelola Materi - Panel Guru')

@section('content')
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-0 text-dark">Daftar Materi Pembelajaran</h2>
            <p class="text-muted mb-0">Kelola konten dan materi ajar Anda di bawah ini</p>
        </div>
        <a href="{{ route('guru.materi.create') }}" class="btn btn-primary">
            + Tambah Materi
        </a>
    </div>
</div>

{{-- Success Alert --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        @if($materi->isEmpty())
            <div class="text-center py-5">
                <div class="text-muted fs-1 mb-3">📂</div>
                <h5 class="fw-bold">Belum ada materi pembelajaran</h5>
                <p class="text-muted px-4">Silakan klik tombol <strong>Tambah Materi</strong> untuk membuat materi pertama Anda.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" style="width: 5%">No</th>
                            <th style="width: 45%">Judul Materi</th>
                            <th style="width: 20%">Tanggal Upload</th>
                            <th style="width: 10%">File Lampiran</th>
                            <th class="pe-4 text-end" style="width: 20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materi as $index => $item)
                            <tr>
                                <td class="ps-4 fw-medium text-secondary">{{ $index + 1 }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $item->judul }}</div>
                                    <div class="small text-muted">{{ Str::limit($item->isi_materi, 80) }}</div>
                                </td>
                                <td class="text-secondary">
                                    {{ $item->tgl_upload ? \Carbon\Carbon::parse($item->tgl_upload)->format('d M Y H:i') : '-' }}
                                </td>
                                <td>
                                    @if($item->file_materi)
                                        <span class="badge bg-success small">Ada File</span>
                                    @else
                                        <span class="badge bg-secondary small">Tidak Ada</span>
                                    @endif
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="btn-group gap-1">
                                        <a href="{{ route('guru.materi.show', $item->id_materi) }}" class="btn btn-outline-info btn-sm">
                                            Detail
                                        </a>
                                        <a href="{{ route('guru.materi.edit', $item->id_materi) }}" class="btn btn-outline-warning btn-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('guru.materi.destroy', $item->id_materi) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
