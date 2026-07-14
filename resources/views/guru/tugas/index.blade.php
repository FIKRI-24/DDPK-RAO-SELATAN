@extends('layouts.app')

@section('title', 'Kelola Tugas - Panel Guru')

@section('content')
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-0 text-dark">Daftar Tugas Pembelajaran</h2>
            <p class="text-muted mb-0">Kelola daftar tugas berdasarkan materi ajar Anda</p>
        </div>
        <a href="{{ route('guru.tugas.create') }}" class="btn btn-primary">
            + Tambah Tugas
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

{{-- Error Alert --}}
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        @if($tugas->isEmpty())
            <div class="text-center py-5">
                <div class="text-muted fs-1 mb-3">📝</div>
                <h5 class="fw-bold">Belum ada tugas pembelajaran</h5>
                <p class="text-muted px-4">Silakan klik tombol <strong>Tambah Tugas</strong> untuk membuat tugas pertama Anda.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" style="width: 5%">No</th>
                            <th style="width: 40%">Nama Tugas</th>
                            <th style="width: 25%">Materi Terkait</th>
                            <th style="width: 15%">Tanggal Dibuat</th>
                            <th class="pe-4 text-end" style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tugas as $index => $item)
                            <tr>
                                <td class="ps-4 fw-medium text-secondary">{{ $index + 1 }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $item->nama_tugas }}</div>
                                    <div class="small text-muted">{{ Str::limit($item->deskripsi, 60) }}</div>
                                </td>
                                <td class="text-dark fw-medium">
                                    {{ $item->materi->judul ?? '-' }}
                                </td>
                                <td class="text-secondary small">
                                    {{ $item->created_at->format('d M Y H:i') }}
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="btn-group gap-1">
                                        <a href="{{ route('guru.tugas.show', $item->id_tugas) }}" class="btn btn-outline-info btn-sm">
                                            Detail
                                        </a>
                                        <a href="{{ route('guru.tugas.edit', $item->id_tugas) }}" class="btn btn-outline-warning btn-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('guru.tugas.destroy', $item->id_tugas) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
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
