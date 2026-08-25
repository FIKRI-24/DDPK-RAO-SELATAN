@extends('layouts.app')

@section('title', 'Edit Siswa - Panel Guru')

@section('content')
<div class="row mb-4 justify-content-center">
    <div class="col-lg-8">
        <h2 class="fw-bold mb-0 text-dark">Ubah Data Siswa</h2>
        <p class="text-muted">Perbarui data atau password akun siswa</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('guru.siswa.update', $siswa->id_siswa) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nama Lengkap --}}
                    <div class="mb-4">
                        <label for="nama" class="form-label fw-bold d-flex align-items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            <span>Nama Lengkap</span>
                        </label>
                        <input type="text" class="form-control form-control-lg @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $siswa->nama) }}" required placeholder="Masukkan nama lengkap siswa">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- NISN --}}
                    <div class="mb-4">
                        <label for="nisn" class="form-label fw-bold d-flex align-items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><rect x="3" y="4" width="18" height="16" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            <span>NISN (Nomor Induk Siswa Nasional)</span>
                        </label>
                        <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="nisn" name="nisn" value="{{ old('nisn', $siswa->nisn) }}" required placeholder="Contoh: 0012345678">
                        @error('nisn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Kelas (Terkunci Otomatis untuk Kelas X) --}}
                    <div class="mb-4">
                        <label for="kelas" class="form-label fw-bold d-flex align-items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><path d="M22 10v6M2 10v6M22 10l-10-5-10 5 10 5z"/><path d="M6 12v5c0 2 2 3 6 3s6-1 6-3v-5"/></svg>
                            <span>Kelas</span>
                            <span class="badge bg-secondary-subtle text-secondary small ms-1">Terkunci</span>
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control bg-light fw-bold text-dark @error('kelas') is-invalid @enderror" id="kelas" name="kelas" value="Kelas X" readonly required>
                            <span class="input-group-text bg-light text-muted small">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                Sasaran Kelas DDPK
                            </span>
                        </div>
                        <small class="text-muted mt-1 d-block">Media pembelajaran ini dikhususkan untuk siswa <strong>Kelas X</strong> SMK Negeri 1 Rao Selatan.</small>
                        @error('kelas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Username --}}
                    <div class="mb-4">
                        <label for="username" class="form-label fw-bold d-flex align-items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><circle cx="12" cy="12" r="4"/><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"/></svg>
                            <span>Username</span>
                        </label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $siswa->username) }}" required placeholder="Masukkan username untuk login siswa">
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-4">
                        <label for="password" class="form-label fw-bold d-flex align-items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            <span>Password (Opsional)</span>
                        </label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password siswa">
                        <div class="form-text text-muted small mt-2">Masukkan password baru jika siswa lupa password lamanya. Minimal 6 karakter.</div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex gap-2 border-top pt-3 mt-4">
                        <button type="submit" class="btn btn-primary px-4 d-flex align-items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                            <span>Perbarui Data</span>
                        </button>
                        <a href="{{ route('guru.siswa.index') }}" class="btn btn-outline-secondary px-4">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
