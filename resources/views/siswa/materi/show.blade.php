@extends('layouts.app')

@section('title', 'Detail Materi - ' . $materi->judul)

@section('content')
<!-- Header & Navigasi Balik -->
<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <span class="text-uppercase text-primary small fw-bold tracking-wider">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="me-1"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
            Modul Pembelajaran
        </span>
        <h2 class="fw-bold mb-1 text-dark">{{ $materi->judul }}</h2>
        <p class="mb-0 fw-medium" style="color: #475569;">Pelajari uraian materi, unduh berkas modul, dan selesaikan latihan tugas yang tersedia.</p>
    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <a href="{{ route('siswa.materi.index') }}" class="btn btn-outline-secondary btn-sm fw-semibold">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Kembali ke Daftar Materi
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Main Content: Isi Materi -->
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 rounded-3 bg-white mb-4">
            <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 bg-primary bg-opacity-10 text-primary rounded-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    </div>
                    <h5 class="fw-bold mb-0 text-dark">Uraian & Penjelasan Materi</h5>
                </div>
            </div>
            <div class="card-body p-4 p-md-5">
                <!-- Meta Info Bar -->
                <div class="p-3 bg-light rounded-3 mb-4 d-flex flex-wrap align-items-center justify-content-between gap-2 border">
                    <div class="d-flex align-items-center gap-2">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 32px; height: 32px; font-size: 0.85rem;">
                            G
                        </div>
                        <div>
                            <span class="d-block text-muted small" style="font-size: 0.75rem;">Disusun oleh Guru:</span>
                            <strong class="text-dark">{{ $materi->guru->nama ?? 'Guru' }}</strong>
                        </div>
                    </div>
                    <div class="text-md-end text-muted small fw-medium">
                        <span>📅 Diunggah pada: {{ $materi->tgl_upload ? \Carbon\Carbon::parse($materi->tgl_upload)->format('d M Y, H:i') : '-' }} WIB</span>
                    </div>
                </div>

                <!-- Text Content Body -->
                <div class="materi-content text-dark" style="font-size: 1.05rem; line-height: 1.8; color: #1e293b !important; white-space: pre-line;">
                    {!! nl2br(e($materi->isi_materi)) !!}
                </div>

                <!-- File Attachment Box (if exists) -->
                @if($materi->file_materi)
                    <div class="card border-0 rounded-3 p-4 mt-5" style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); border: 1.5px solid #bfdbfe !important;">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="p-3 bg-primary text-white rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 48px; height: 48px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1 text-primary">Berkas Dokumen / Modul PDF</h6>
                                    <p class="small text-muted mb-0 fw-medium">{{ basename($materi->file_materi) }}</p>
                                </div>
                            </div>
                            <div>
                                <a href="{{ asset('storage/' . $materi->file_materi) }}" target="_blank" class="btn btn-primary fw-bold px-4 py-2 shadow-sm d-flex align-items-center gap-2 text-nowrap">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                    <span>Unduh Modul</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar: Tugas & Navigasi Belajar -->
    <div class="col-lg-4">
        <!-- Card Tindakan Lanjutan -->
        <div class="card shadow-sm border-0 rounded-3 bg-white p-4 mb-4">
            <h6 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                Langkah Belajar Selanjutnya
            </h6>
            <p class="small fw-medium mb-3" style="color: #475569; line-height: 1.6;">
                Setelah memahami materi di atas, silakan cek apakah ada latihan tugas praktikum yang perlu Anda kerjakan.
            </p>
            <a href="{{ route('siswa.tugas.index') }}" class="btn btn-outline-primary fw-semibold w-100 py-2 d-flex align-items-center justify-content-center gap-2">
                <span>Buka Menu Tugas</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>

        <!-- Tips Belajar Card -->
        <div class="card border-0 rounded-3 p-4 text-white shadow-sm" style="background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);">
            <div class="d-flex align-items-center gap-2 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <h6 class="fw-bold mb-0 text-white">Tips Pemahaman</h6>
            </div>
            <p class="small text-white fw-normal mb-0" style="line-height: 1.6;">
                Catat poin-poin penting seperti sintaks kode atau algoritma alur logika agar memudahkanmu saat mengerjakan tugas dan proyek.
            </p>
        </div>
    </div>
</div>
@endsection
