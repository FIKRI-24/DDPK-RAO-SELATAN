@extends('layouts.app')

@section('title', 'Kelola Siswa - Panel Guru')

@section('content')
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-0 text-dark">Kelola Data Siswa</h2>
            <p class="text-muted mb-0">Kelola akun dan informasi siswa SMK Negeri 1 Rao Selatan</p>
        </div>
        <a href="{{ route('guru.siswa.create') }}" class="btn btn-primary">
            + Tambah Siswa
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
        @if($siswa->isEmpty())
            <div class="text-center py-5">
                <div class="text-muted fs-1 mb-3">👥</div>
                <h5 class="fw-bold">Belum ada data siswa</h5>
                <p class="text-muted px-4">Silakan klik tombol <strong>Tambah Siswa</strong> untuk membuat akun siswa pertama.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" style="width: 5%">No</th>
                            <th style="width: 25%">Nama Lengkap</th>
                            <th style="width: 15%">NISN</th>
                            <th style="width: 15%">Kelas</th>
                            <th style="width: 15%">Username</th>
                            <th style="width: 10%">Terdaftar</th>
                            <th class="pe-4 text-end" style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswa as $index => $item)
                            <tr>
                                <td class="ps-4 fw-medium text-secondary">{{ $index + 1 }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $item->nama }}</div>
                                </td>
                                <td class="text-secondary font-monospace">{{ $item->nisn }}</td>
                                <td>
                                    <span class="badge text-primary" style="background-color: rgba(32, 107, 196, 0.1); font-weight: 600; padding: 0.25rem 0.6rem; border-radius: 4px; font-size: 0.85rem;">
                                        {{ $item->kelas }}
                                    </span>
                                </td>
                                <td class="text-secondary">{{ $item->username }}</td>
                                <td class="text-secondary small">
                                    {{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="btn-group gap-1">
                                        <a href="{{ route('guru.siswa.edit', $item->id_siswa) }}" class="btn btn-outline-warning btn-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('guru.siswa.destroy', $item->id_siswa) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa ini? Semua riwayat pengumpulan tugas dan nilainya juga akan dihapus permanen.')">
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
