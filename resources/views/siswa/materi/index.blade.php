@extends('layouts.app')

@section('title', 'Materi Pembelajaran - Siswa')

@section('content')
<!-- Header Halaman -->
<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <span class="text-uppercase text-primary small fw-bold tracking-wider">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="me-1"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10"/><path d="M6 10h10"/><path d="M13 14h3"/></svg>
            Modul Belajar DDPK
        </span>
        <h2 class="fw-bold mb-1 text-dark">Daftar Materi Pembelajaran</h2>
        <p class="mb-0 fw-medium" style="color: #475569;">Akses seluruh modul materi teori, konsep algoritma, dan pemrograman dasar yang disiapkan Guru.</p>
    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <span class="badge bg-white text-dark border px-3 py-2 fw-bold shadow-sm rounded-pill">
            📚 Total: {{ $materi->count() }} Materi Tersedia
        </span>
    </div>
</div>

@if($materi->isEmpty())
    <div class="card shadow-sm border-0 rounded-4 bg-white">
        <div class="card-body py-5 text-center">
            <div class="d-inline-flex p-3 bg-light rounded-circle text-primary mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10"/><path d="M6 10h10"/></svg>
            </div>
            <h5 class="fw-bold text-dark mb-1">Belum Ada Materi Pembelajaran</h5>
            <p class="text-muted mb-0">Guru belum mengunggah materi modul untuk saat ini. Silakan periksa kembali nanti.</p>
        </div>
    </div>
@else
    <div class="row g-4">
        @foreach($materi as $index => $item)
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 h-100 rounded-3 bg-white d-flex flex-column transition-hover" 
                     style="transition: all 0.25s ease-in-out; border: 1px solid #e2e8f0 !important;">
                    
                    <!-- Card Top Header -->
                    <div class="card-body p-4 flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-primary bg-opacity-10 text-primary fw-bold px-2 py-1 rounded-pill small">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="me-1"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                                Modul {{ $index + 1 }}
                            </span>
                            
                            @if($item->file_materi)
                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1 rounded-pill small fw-bold">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="me-1"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                    Ada Berkas PDF
                                </span>
                            @endif
                        </div>

                        <!-- Title -->
                        <h5 class="fw-extrabold text-dark mb-2" style="font-size: 1.15rem; line-height: 1.4;">
                            {{ $item->judul }}
                        </h5>

                        <!-- Meta Info (Teacher & Date) -->
                        <div class="d-flex flex-column gap-1 mb-3 pt-2 border-top border-bottom py-2" style="font-size: 0.84rem;">
                            <div class="d-flex align-items-center gap-1 text-dark fw-semibold">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-secondary"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                <span>Guru: <strong class="text-primary">{{ $item->guru->nama ?? 'Guru' }}</strong></span>
                            </div>
                            <div class="d-flex align-items-center gap-1 text-muted">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                <span>Diunggah: {{ $item->tgl_upload ? \Carbon\Carbon::parse($item->tgl_upload)->format('d M Y') : '-' }}</span>
                            </div>
                        </div>

                        <!-- Description preview -->
                        <p class="card-text fw-medium mb-0" style="color: #475569; font-size: 0.9rem; line-height: 1.6;">
                            {{ Str::limit(strip_tags($item->isi_materi), 110) }}
                        </p>
                    </div>

                    <!-- Card Footer Action -->
                    <div class="card-footer bg-white border-0 px-4 pb-4 pt-0">
                        <div class="d-flex gap-2">
                            <a href="{{ route('siswa.materi.show', $item->id_materi) }}" class="btn btn-primary flex-grow-1 fw-bold py-2 shadow-sm d-flex align-items-center justify-content-center gap-2">
                                <span>Pelajari Materi</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                            </a>
                            @if($item->file_materi)
                                <a href="{{ route('materi.unduh', $item->id_materi) }}" target="_blank" class="btn btn-outline-primary fw-bold px-3 py-2 shadow-sm d-flex align-items-center justify-content-center gap-1" title="Unduh Berkas Lampiran">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                    <span class="small d-none d-sm-inline">Unduh</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
