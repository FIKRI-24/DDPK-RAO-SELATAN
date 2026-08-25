@extends('layouts.app')

@section('title', 'Beri Nilai - Panel Guru')

@section('content')
<div class="row mb-4 justify-content-center">
    <div class="col-lg-6">
        <h2 class="fw-bold mb-0 text-dark">Input / Edit Nilai Tugas</h2>
        <p class="text-muted">Masukkan nilai evaluasi siswa untuk pengerjaan tugas</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <!-- Informasi Pengumpulan Card -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3 px-4 border-bottom">
                <h5 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    <span>Informasi Pengumpulan</span>
                </h5>
            </div>
            <div class="card-body p-4">
                <table class="table table-borderless align-middle mb-0" style="font-size: 0.9rem;">
                    <tr>
                        <td class="text-muted ps-0 py-2" style="width: 35%">Nama Siswa</td>
                        <td class="fw-bold text-dark py-2">: {{ $hasil->siswa->nama }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted ps-0 py-2">NISN / Kelas</td>
                        <td class="text-dark py-2">: {{ $hasil->siswa->nisn ?? '-' }} (Kelas {{ $hasil->siswa->kelas }})</td>
                    </tr>
                    <tr>
                        <td class="text-muted ps-0 py-2">Tugas</td>
                        <td class="text-dark py-2">: {{ $hasil->tugas->nama_tugas }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted ps-0 py-2">Materi</td>
                        <td class="text-dark py-2">: {{ $hasil->tugas->materi->judul }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted ps-0 py-2">Waktu Kumpul</td>
                        <td class="text-dark py-2">: {{ \Carbon\Carbon::parse($hasil->tgl_kumpul)->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted ps-0 py-2">File Jawaban</td>
                        <td class="text-dark py-2">: 
                            <a href="{{ route('jawaban.unduh', $hasil->id_hasil) }}" target="_blank" class="btn btn-sm btn-outline-primary py-1 px-3 d-inline-flex align-items-center gap-1 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                <span>Unduh Jawaban</span>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Form Penilaian Card -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <form action="{{ route('guru.penilaian.update', $hasil->id_hasil) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="nilai" class="form-label fw-bold d-flex align-items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                            <span>Nilai Tugas (0 - 100)</span>
                        </label>
                        <input type="number" class="form-control form-control-lg @error('nilai') is-invalid @enderror" id="nilai" name="nilai" value="{{ old('nilai', $hasil->nilai) }}" min="0" max="100" required placeholder="Masukkan angka 0 - 100">
                        <div class="form-text text-muted small mt-2">Pastikan Anda telah memeriksa berkas jawaban siswa terlebih dahulu.</div>
                        @error('nilai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 border-top pt-3 mt-4">
                        <button type="submit" class="btn btn-primary px-4 d-flex align-items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                            <span>Simpan Nilai</span>
                        </button>
                        <a href="{{ route('guru.penilaian.show', $hasil->id_tugas) }}" class="btn btn-outline-secondary px-4">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
