@extends('layouts.app')

@section('title', 'Detail Materi - Panel Guru')

@section('content')
<div class="row mb-4 justify-content-center">
    <div class="col-lg-8">
        <h2 class="fw-bold mb-0 text-dark">Detail Materi Pembelajaran</h2>
        <p class="text-muted">Melihat informasi detail materi yang telah diunggah</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <h3 class="fw-bold text-primary mb-3">{{ $materi->judul }}</h3>
                <div class="mb-4 d-flex flex-wrap gap-3 text-secondary border-bottom pb-3">
                    <div>
                        👤 Pembuat: <strong>Guru Demo</strong>
                    </div>
                    <div>
                        📅 Diupload: <strong>{{ $materi->tgl_upload ? \Carbon\Carbon::parse($materi->tgl_upload)->format('d M Y H:i') : '-' }}</strong>
                    </div>
                </div>

                <div class="fs-5 mb-4 text-dark" style="white-space: pre-line; line-height: 1.6;">
                    {!! nl2br(e($materi->isi_materi)) !!}
                </div>

                @if($materi->file_materi)
                    <div class="card border-0 rounded-4 mb-4 shadow-sm overflow-hidden" style="background: #ffffff; border: 1.5px solid #c7d2fe !important;">
                        <div class="card-header border-0 py-3 px-4 d-flex align-items-center justify-content-between" style="background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);">
                            <div class="d-flex align-items-center gap-2 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                                <span class="fw-bold fs-6">Berkas Lampiran Modul Pembelajaran</span>
                            </div>
                            <span class="badge bg-white text-primary fw-bold px-2.5 py-1 rounded-pill small">Tersedia</span>
                        </div>
                        <div class="card-body p-4 bg-light bg-opacity-50">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center border border-primary border-opacity-25" style="width: 48px; height: 48px; min-width: 48px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-dark mb-1 text-break">{{ basename($materi->file_materi) }}</h6>
                                        <p class="small text-muted mb-0 fw-medium">Berkas modul yang dapat diakses dan diunduh oleh siswa.</p>
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <a href="{{ route('materi.unduh', $materi->id_materi) }}" target="_blank" class="btn btn-primary btn-lg fw-bold px-4 py-2.5 shadow-sm d-inline-flex align-items-center gap-2 text-nowrap">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                        <span>Buka / Unduh File</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-secondary border-0 rounded-3 mb-4 d-flex align-items-center gap-2" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-muted"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                        <span>Materi ini tidak menyertakan berkas lampiran fisik.</span>
                    </div>
                @endif

                <div class="d-flex gap-2">
                    <a href="{{ route('guru.materi.edit', $materi->id_materi) }}" class="btn btn-warning px-4">
                        Edit Materi
                    </a>
                    <a href="{{ route('guru.materi.index') }}" class="btn btn-outline-secondary px-4">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
