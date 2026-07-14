@extends('layouts.app')

@section('title', 'Detail Materi - Siswa')

@section('content')
<div class="row mb-4 justify-content-center">
    <div class="col-lg-8">
        <h2 class="fw-bold mb-0 text-dark">Baca Materi Pembelajaran</h2>
        <p class="text-muted">Membaca isi materi pembelajaran lengkap</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <h3 class="fw-bold text-primary mb-3">{{ $materi->judul }}</h3>
                <div class="mb-4 d-flex flex-wrap gap-3 text-secondary border-bottom pb-3">
                    <div>
                        👤 Pembuat: <strong>{{ $materi->guru->nama ?? 'Guru' }}</strong>
                    </div>
                    <div>
                        📅 Diupload: <strong>{{ $materi->tgl_upload ? \Carbon\Carbon::parse($materi->tgl_upload)->format('d M Y H:i') : '-' }}</strong>
                    </div>
                </div>

                <div class="fs-5 mb-4 text-dark" style="white-space: pre-line; line-height: 1.6;">
                    {!! nl2br(e($materi->isi_materi)) !!}
                </div>

                @if($materi->file_materi)
                    <div class="card border-primary bg-light mb-4">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-bold mb-1 text-primary">📄 File Lampiran Materi</h6>
                                <p class="small text-muted mb-0">{{ basename($materi->file_materi) }}</p>
                            </div>
                            <a href="{{ asset('storage/' . $materi->file_materi) }}" target="_blank" class="btn btn-primary px-4">
                                Buka / Unduh File
                            </a>
                        </div>
                    </div>
                @else
                    <div class="alert alert-secondary border-0 mb-4" role="alert">
                        ℹ️ Materi ini tidak menyertakan berkas lampiran.
                    </div>
                @endif

                <div>
                    <a href="{{ route('siswa.materi.index') }}" class="btn btn-outline-secondary px-4">
                        &larr; Kembali ke Daftar Materi
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
