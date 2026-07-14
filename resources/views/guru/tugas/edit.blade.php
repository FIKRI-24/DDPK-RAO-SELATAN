@extends('layouts.app')

@section('title', 'Edit Tugas - Panel Guru')

@section('content')
<div class="row mb-4 justify-content-center">
    <div class="col-lg-8">
        <h2 class="fw-bold mb-0 text-dark">Edit Tugas</h2>
        <p class="text-muted">Perbarui petunjuk dan rincian tugas pembelajaran</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0" style="border-top: 3px solid #206bc4 !important;">
            <div class="card-body p-4">
                <form action="{{ route('guru.tugas.update', $tugas->id_tugas) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Materi (Read Only) --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold d-flex align-items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10"/><path d="M6 10h10"/></svg>
                            <span>Materi Terkait</span>
                        </label>
                        <input type="text" class="form-control form-control-lg bg-light text-dark" value="{{ $tugas->materi->judul }}" readonly>
                        <div class="form-text text-muted small mt-2">Materi terkait tugas tidak dapat diubah kembali.</div>
                    </div>

                    {{-- Nama Tugas --}}
                    <div class="mb-4">
                        <label for="nama_tugas" class="form-label fw-bold d-flex align-items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                            <span>Nama Tugas</span>
                        </label>
                        <input type="text" class="form-control form-control-lg @error('nama_tugas') is-invalid @enderror" id="nama_tugas" name="nama_tugas" value="{{ old('nama_tugas', $tugas->nama_tugas) }}" required>
                        @error('nama_tugas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-4">
                        <label for="deskripsi" class="form-label fw-bold d-flex align-items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                            <span>Petunjuk / Deskripsi Tugas</span>
                        </label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="8">{{ old('deskripsi', $tugas->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex gap-2 border-top pt-3 mt-4">
                        <button type="submit" class="btn btn-primary px-4 d-flex align-items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                            <span>Simpan Perubahan</span>
                        </button>
                        <a href="{{ route('guru.tugas.index') }}" class="btn btn-outline-secondary px-4">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
