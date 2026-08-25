@extends('layouts.app')

@section('title', 'Detail Nilai Tugas - Siswa')

@section('content')
<!-- Page Header -->
<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <span class="text-uppercase text-primary small fw-bold tracking-wider">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="me-1"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
            Detail Evaluasi Tugas
        </span>
        <h2 class="fw-bold mb-1 text-dark">Rincian Hasil & Nilai Tugas</h2>
        <p class="mb-0 fw-medium" style="color: #475569;">Lihat skor evaluasi guru, berkas jawaban yang dikirim, serta saran perbaikan belajar.</p>
    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <a href="{{ route('siswa.nilai.index') }}" class="btn btn-outline-secondary btn-sm fw-semibold">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Kembali ke Rekap Nilai
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Left Column: Informasi Tugas -->
    <div class="col-lg-7">
        <div class="card shadow-sm border-0 h-100 rounded-3 bg-white">
            <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                <div class="p-2 bg-primary bg-opacity-10 text-primary rounded-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                </div>
                <h5 class="fw-bold mb-0 text-dark">Instruksi & Soal Tugas</h5>
            </div>
            <div class="card-body p-4">
                <h4 class="fw-extrabold text-primary mb-3">{{ $tugas->nama_tugas }}</h4>
                
                <div class="p-3 bg-light rounded-3 mb-4 d-flex flex-wrap gap-4 border" style="color: #334155; font-size: 0.9rem;">
                    <div>
                        <span class="d-block text-muted small">Materi Terkait:</span>
                        <strong>📖 {{ $tugas->materi->judul ?? '-' }}</strong>
                    </div>
                    <div>
                        <span class="d-block text-muted small">Guru Pengampu:</span>
                        <strong>👤 {{ $tugas->materi->guru->nama ?? 'Guru' }}</strong>
                    </div>
                    @if($tugas->tgl_deadline)
                        <div>
                            <span class="d-block text-muted small">Batas Deadline:</span>
                            <strong class="text-danger">⏰ {{ \Carbon\Carbon::parse($tugas->tgl_deadline)->format('d M Y H:i') }}</strong>
                        </div>
                    @endif
                </div>

                <h6 class="fw-bold text-dark mb-2">Deskripsi Instruksi:</h6>
                <div class="p-3 bg-white rounded border mb-0" style="color: #1e293b; white-space: pre-line; line-height: 1.7; font-size: 0.95rem;">
                    {!! nl2br(e($tugas->deskripsi)) !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Status Jawaban & Nilai -->
    <div class="col-lg-5">
        <div class="card shadow-sm border-0 h-100 rounded-3 bg-white">
            <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                <div class="p-2 bg-success bg-opacity-10 text-success rounded-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                </div>
                <h5 class="fw-bold mb-0 text-dark">Hasil Evaluasi Guru</h5>
            </div>
            <div class="card-body p-4 d-flex flex-column">

                @if($hasil && $hasil->file_jawaban)
                    <!-- Submission Info Badge -->
                    <div class="alert alert-success border-0 rounded-3 p-3 mb-4 d-flex align-items-center gap-3">
                        <div class="bg-success text-white rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        <div>
                            <strong class="text-success d-block">Tugas Berhasil Dikumpulkan</strong>
                            <span class="small text-muted">Diserahkan pada: {{ \Carbon\Carbon::parse($hasil->tgl_kumpul)->format('d M Y, H:i') }} WIB</span>
                        </div>
                    </div>

                    <!-- File Download Box -->
                    <div class="p-3 bg-light rounded-3 border mb-4">
                        <span class="fw-bold small d-block mb-2 text-secondary text-uppercase" style="font-size: 0.75rem;">Berkas Jawaban Anda:</span>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-2 text-truncate me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                <span class="fw-bold text-dark small text-truncate">{{ basename($hasil->file_jawaban) }}</span>
                            </div>
                            <a href="{{ route('jawaban.unduh', $hasil->id_hasil) }}" target="_blank" class="btn btn-sm btn-outline-primary fw-semibold px-3 text-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                Unduh File
                            </a>
                        </div>
                    </div>

                    <!-- Score Card Section -->
                    <div class="card border-0 rounded-3 text-center p-4 mt-auto" 
                         style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border: 1.5px solid #86efac !important;">
                        <span class="text-uppercase fw-bold text-success small tracking-wider mb-1 d-block">Skor Nilai Diperoleh</span>
                        
                        @if($hasil->nilai !== null)
                            <div class="my-1">
                                <span class="display-3 fw-extrabold text-success">{{ $hasil->nilai }}</span>
                                <span class="text-muted fw-bold">/ 100</span>
                            </div>
                            <p class="small text-success fw-medium mb-0">Tugas ini telah dinilai oleh Guru.</p>
                        @else
                            <div class="my-2">
                                <span class="badge bg-warning bg-opacity-20 text-warning-emphasis border border-warning px-3 py-2 fs-6 rounded-pill fw-bold">
                                    Sedang Dinilai
                                </span>
                            </div>
                            <p class="small text-muted mb-0">Jawaban Anda sedang dalam antrean evaluasi Guru.</p>
                        @endif
                    </div>

                @else
                    <!-- Not submitted alert -->
                    <div class="alert alert-warning border-0 rounded-3 p-3 mb-4 d-flex align-items-center gap-3">
                        <div class="bg-warning text-dark rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                        <div>
                            <strong class="text-dark d-block">Belum Mengumpulkan Jawaban</strong>
                            <span class="small text-muted">Anda belum mengirimkan berkas jawaban untuk tugas ini.</span>
                        </div>
                    </div>

                    <div class="text-center py-5 border rounded-3 bg-light mt-auto">
                        <div class="fs-1 text-muted mb-2">📂</div>
                        <h6 class="fw-bold text-dark mb-1">Belum Ada Nilai</h6>
                        <p class="small text-muted mb-3">Kumpulkan tugas sebelum tenggat waktu untuk mendapatkan penilaian.</p>
                        <a href="{{ route('siswa.tugas.show', $tugas->id_tugas) }}" class="btn btn-primary btn-sm fw-semibold px-4">
                            Kumpulkan Tugas Sekarang &rarr;
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
