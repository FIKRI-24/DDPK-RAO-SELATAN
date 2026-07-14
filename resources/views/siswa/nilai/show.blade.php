@extends('layouts.app')

@section('title', 'Detail Nilai Tugas - Siswa')

@section('content')
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-0 text-dark">Rincian Nilai Tugas</h2>
            <p class="text-muted mb-0">Melihat nilai evaluasi guru dan berkas jawaban yang Anda kumpulkan</p>
        </div>
        <a href="{{ route('siswa.nilai.index') }}" class="btn btn-outline-secondary">
            &larr; Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-7 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body p-4">
                <span class="badge bg-secondary mb-2">Petunjuk Tugas</span>
                <h3 class="fw-bold text-primary mb-3">{{ $tugas->nama_tugas }}</h3>
                
                <div class="mb-4 d-flex flex-wrap gap-3 text-secondary border-bottom pb-3 small">
                    <div>
                        📖 Materi: <strong>{{ $tugas->materi->judul ?? '-' }}</strong>
                    </div>
                    <div>
                        👤 Oleh: <strong>{{ $tugas->materi->guru->nama ?? 'Guru' }}</strong>
                    </div>
                </div>

                <div class="fs-5 mb-4 text-dark" style="white-space: pre-line; line-height: 1.6;">
                    {!! nl2br(e($tugas->deskripsi)) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body p-4 d-flex flex-column">
                <h5 class="fw-bold text-dark mb-3 border-bottom pb-2">Status & Nilai</h5>

                @if($hasil && $hasil->file_jawaban)
                    <div class="alert alert-success border-0 mb-4" role="alert">
                        <div class="fw-bold">✔️ Tugas Sudah Dikumpulkan</div>
                        <div class="small mt-1">
                            Diserahkan pada: <strong>{{ \Carbon\Carbon::parse($hasil->tgl_kumpul)->format('d M Y H:i') }}</strong>
                        </div>
                    </div>

                    <div class="mb-4 p-3 bg-light border rounded">
                        <div class="fw-bold small text-secondary mb-2">File Jawaban Anda:</div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="small text-truncate me-2 fw-medium">
                                📂 {{ basename($hasil->file_jawaban) }}
                            </span>
                            <a href="{{ Storage::url($hasil->file_jawaban) }}" target="_blank" class="btn btn-sm btn-outline-primary py-0">
                                Buka File
                            </a>
                        </div>
                    </div>

                    <div class="card border-primary bg-light mb-0 mt-auto">
                        <div class="card-body text-center py-4">
                            <h6 class="text-uppercase text-secondary fw-bold mb-2">Nilai Evaluasi Guru</h6>
                            @if($hasil->nilai !== null)
                                <span class="display-3 fw-bold text-success">{{ $hasil->nilai }}</span>
                                <p class="small text-muted mt-2 mb-0">Tugas Anda telah dinilai oleh Guru.</p>
                            @else
                                <span class="fs-4 fw-bold text-warning">Belum Dinilai</span>
                                <p class="small text-muted mt-2 mb-0">Jawaban Anda sedang menunggu evaluasi dari Guru.</p>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning border-0 mb-4 text-dark" role="alert">
                        <div class="fw-bold">⏳ Belum Mengumpulkan</div>
                        <div class="small mt-1">Anda belum mengunggah berkas jawaban untuk tugas ini.</div>
                    </div>
                    
                    <div class="text-center py-4 border rounded bg-light mt-auto">
                        <span class="fs-1">📂</span>
                        <h6 class="fw-bold text-secondary mt-2 mb-0">Tidak ada nilai</h6>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
