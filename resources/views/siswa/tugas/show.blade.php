@extends('layouts.app')

@section('title', 'Kumpulkan Tugas - Siswa')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-0 text-dark">Kumpulkan Tugas</h2>
        <p class="text-muted">Baca petunjuk pengerjaan tugas dan unggah file jawaban Anda</p>
    </div>
</div>

{{-- Success Alert --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row">
    {{-- Petunjuk Tugas --}}
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

                <div>
                    <a href="{{ route('siswa.tugas.index') }}" class="btn btn-outline-secondary px-4">
                        &larr; Kembali ke Daftar Tugas
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Form Pengumpulan --}}
    <div class="col-lg-5 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body p-4">
                <h5 class="fw-bold text-dark mb-3 border-bottom pb-2">Status Pengumpulan</h5>

                @if($hasil && $hasil->file_jawaban)
                    <div class="alert alert-success border-0 mb-4" role="alert">
                        <div class="fw-bold">✔️ Tugas Sudah Dikumpulkan</div>
                        <div class="small mt-1">
                            Diterima pada: <strong>{{ \Carbon\Carbon::parse($hasil->tgl_kumpul)->format('d M Y H:i') }}</strong>
                        </div>
                    </div>

                    <div class="mb-4 p-3 bg-light border rounded">
                        <div class="fw-bold small text-secondary mb-2">File Jawaban Anda:</div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="small text-truncate me-2 fw-medium">
                                📂 {{ basename($hasil->file_jawaban) }}
                            </span>
                            <a href="{{ route('jawaban.unduh', $hasil->id_hasil) }}" target="_blank" class="btn btn-sm btn-outline-primary py-0">
                                Buka File
                            </a>
                        </div>
                    </div>
                    <p class="text-muted small">Anda dapat memperbarui/mengunggah ulang file jawaban Anda menggunakan form di bawah.</p>
                @else
                    <div class="alert alert-warning border-0 mb-4 text-dark" role="alert">
                        <div class="fw-bold">⏳ Belum Mengumpulkan</div>
                        <div class="small mt-1">Silakan unggah file jawaban Anda untuk diserahkan ke Guru.</div>
                    </div>
                @endif

                <form action="{{ route('siswa.tugas.submit', $tugas->id_tugas) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="file_jawaban" class="form-label fw-bold">Pilih File Jawaban</label>
                        <input type="file" class="form-control @error('file_jawaban') is-invalid @enderror" id="file_jawaban" name="file_jawaban" required>
                        <div class="form-text text-muted small mt-2">
                            Mendukung file: <strong>pdf, doc, docx, ppt, pptx, jpg, jpeg, png, zip, rar</strong>. Maksimal 5 MB.
                        </div>
                        @error('file_jawaban')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary btn-lg fs-6">
                            {{ $hasil && $hasil->file_jawaban ? 'Perbarui Jawaban' : 'Kirim Jawaban' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
