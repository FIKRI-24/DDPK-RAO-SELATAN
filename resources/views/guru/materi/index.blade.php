@extends('layouts.app')

@section('title', 'Kelola Materi - Panel Guru')

@section('content')
<!-- Header Kelola Materi -->
<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <span class="text-uppercase text-primary small fw-bold tracking-wider">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="me-1"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10"/><path d="M6 10h10"/><path d="M13 14h3"/></svg>
            Manajemen Konten
        </span>
        <h2 class="fw-bold mb-1 text-dark">Daftar Materi Pembelajaran</h2>
        <p class="mb-0 fw-medium" style="color: #475569;">Kelola modul teori, bahan ajar dokumen PDF, dan video pembelajaran DDPK untuk siswa.</p>
    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <a href="{{ route('guru.materi.create') }}" class="btn btn-primary fw-semibold px-3 shadow-sm d-inline-flex align-items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            <span>Tambah Materi Baru</span>
        </a>
    </div>
</div>

{{-- Success Alert --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4 rounded-3 d-flex align-items-center" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2 text-success"><polyline points="20 6 9 17 4 12"/></svg>
        <div class="fw-semibold">{{ session('success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-sm border-0 rounded-3 overflow-hidden bg-white mb-4">
    <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <div class="p-2 bg-primary bg-opacity-10 text-primary rounded-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10"/><path d="M6 10h10"/></svg>
            </div>
            <h5 class="fw-bold mb-0 text-dark">Daftar Modul Terbit</h5>
        </div>
        <span class="badge bg-light text-dark fw-bold border px-3 py-2">
            Total: {{ $materi->count() }} Materi
        </span>
    </div>
    <div class="card-body p-0">
        @if($materi->isEmpty())
            <div class="text-center py-5">
                <div class="d-inline-flex p-3 bg-light rounded-circle text-primary mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10"/><path d="M6 10h10"/></svg>
                </div>
                <h5 class="fw-bold text-dark mb-1">Belum Ada Materi Pembelajaran</h5>
                <p class="text-muted px-4 mb-3">Silakan klik tombol <strong>Tambah Materi Baru</strong> untuk membuat materi pertama Anda.</p>
                <a href="{{ route('guru.materi.create') }}" class="btn btn-primary btn-sm fw-semibold">
                    + Tambah Sekarang
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light" style="border-bottom: 2px solid #e2e8f0;">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase fw-bold text-secondary" style="width: 5%; font-size: 0.8rem;">No</th>
                            <th class="py-3 text-uppercase fw-bold text-secondary" style="width: 45%; font-size: 0.8rem;">Judul & Uraian Singkat</th>
                            <th class="py-3 text-uppercase fw-bold text-secondary" style="width: 20%; font-size: 0.8rem;">Tanggal Upload</th>
                            <th class="py-3 text-uppercase fw-bold text-secondary text-center" style="width: 12%; font-size: 0.8rem;">File Modul</th>
                            <th class="pe-4 py-3 text-uppercase fw-bold text-secondary text-end" style="width: 18%; font-size: 0.8rem;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materi as $index => $item)
                            <tr>
                                <td class="ps-4 fw-bold text-muted">{{ $index + 1 }}</td>
                                <td class="py-3">
                                    <div class="fw-bold text-dark fs-6">{{ $item->judul }}</div>
                                    <div class="small fw-medium mt-1" style="color: #64748b;">
                                        {{ Str::limit(strip_tags($item->isi_materi), 85) }}
                                    </div>
                                </td>
                                <td>
                                    <span class="small fw-semibold text-dark d-flex align-items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-secondary"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                        {{ $item->tgl_upload ? \Carbon\Carbon::parse($item->tgl_upload)->format('d M Y, H:i') : '-' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if($item->file_materi)
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1 rounded-pill small fw-bold">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="me-1"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                            Ada File
                                        </span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 px-2 py-1 rounded-pill small fw-medium">
                                            Tanpa File
                                        </span>
                                    @endif
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="d-flex justify-content-end gap-1">
                                        <a href="{{ route('guru.materi.show', $item->id_materi) }}" class="btn btn-outline-info btn-sm fw-semibold rounded-2 px-2" title="Lihat">
                                            Lihat
                                        </a>
                                        <a href="{{ route('guru.materi.edit', $item->id_materi) }}" class="btn btn-outline-warning btn-sm fw-semibold rounded-2 px-2" title="Edit">
                                            Edit
                                        </a>
                                        <form action="{{ route('guru.materi.destroy', $item->id_materi) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm fw-semibold rounded-2 px-2" title="Hapus">
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
