@extends('layouts.app')

@section('title', 'Edit Materi - Panel Guru')

@section('content')
<div class="row mb-4 justify-content-center">
    <div class="col-lg-8">
        <h2 class="fw-bold mb-0 text-dark">Edit Materi</h2>
        <p class="text-muted">Perbarui informasi materi pembelajaran Anda</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0" style="border-top: 3px solid #206bc4 !important;">
            <div class="card-body p-4">
                <form action="{{ route('guru.materi.update', $materi->id_materi) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Judul --}}
                    <div class="mb-4">
                        <label for="judul" class="form-label fw-bold d-flex align-items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10"/><path d="M6 10h10"/></svg>
                            <span>Judul Materi</span>
                        </label>
                        <input type="text" class="form-control form-control-lg @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $materi->judul) }}" required placeholder="Masukkan judul materi pembelajaran">
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Isi Materi --}}
                    <div class="mb-4">
                        <label for="isi_materi" class="form-label fw-bold d-flex align-items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                            <span>Isi Materi</span>
                        </label>
                        <textarea class="form-control @error('isi_materi') is-invalid @enderror" id="isi_materi" name="isi_materi" rows="10" required placeholder="Tuliskan isi materi atau deskripsi lengkap materi disini...">{{ old('isi_materi', $materi->isi_materi) }}</textarea>
                        @error('isi_materi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- File Materi --}}
                    <div class="mb-4">
                        <label for="file_materi" class="form-label fw-bold d-flex align-items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                            <span>Ganti File Lampiran (Opsional)</span>
                        </label>
                        
                        @if($materi->file_materi)
                            <div class="mb-3 p-3 bg-light border rounded d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-success"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
                                    <span class="small text-dark fw-medium">
                                        {{ basename($materi->file_materi) }}
                                    </span>
                                </div>
                                <a href="{{ route('materi.unduh', $materi->id_materi) }}" target="_blank" class="btn btn-sm btn-outline-primary px-3">
                                    Buka Lampiran
                                </a>
                            </div>
                        @endif

                        <input type="file" class="form-control @error('file_materi') is-invalid @enderror" id="file_materi" name="file_materi">
                        <div class="form-text text-muted small mt-2">
                            Kosongkan jika tidak ingin mengganti file. Tipe yang diperbolehkan: <strong>pdf, doc, docx, ppt, pptx, jpg, jpeg, png</strong>. Maksimal 5 MB.
                        </div>
                        @error('file_materi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex gap-2 border-top pt-3 mt-4">
                        <button type="submit" class="btn btn-primary px-4 d-flex align-items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                            <span>Simpan Perubahan</span>
                        </button>
                        <a href="{{ route('guru.materi.index') }}" class="btn btn-outline-secondary px-4">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
