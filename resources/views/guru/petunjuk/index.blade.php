@extends('layouts.app')

@section('title', 'Petunjuk Penggunaan Guru - Media Pembelajaran DDPK')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <span class="text-uppercase text-primary small fw-bold tracking-wider">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="me-1"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            Buku Panduan & Dokumentasi
        </span>
        <h2 class="fw-bold mb-1 text-dark">Petunjuk Penggunaan Media Guru</h2>
        <p class="text-dark fw-medium mb-0" style="color: #475569 !important;">Panduan lengkap operasional media pembelajaran interaktif DDPK untuk mengelola siswa, materi, tugas, dan penilaian.</p>
    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <a href="{{ route('guru.dashboard') }}" class="btn btn-outline-secondary btn-sm fw-semibold">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Kembali ke Dashboard
        </a>
    </div>
</div>

<!-- Quick Workflow Summary Cards -->
<div class="row mb-4 g-3">
    <div class="col-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm bg-white text-center p-3 rounded-3">
            <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle mb-2 mx-auto" style="width: 44px; height: 44px;">
                <span class="fw-bold fs-5">1</span>
            </div>
            <h6 class="fw-bold mb-1 text-dark">Kelola Siswa</h6>
            <p class="small mb-0 fw-medium" style="color: #64748b;">Registrasi akun & pembagian kelas</p>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm bg-white text-center p-3 rounded-3">
            <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success rounded-circle mb-2 mx-auto" style="width: 44px; height: 44px;">
                <span class="fw-bold fs-5">2</span>
            </div>
            <h6 class="fw-bold mb-1 text-dark">Buat Materi</h6>
            <p class="small mb-0 fw-medium" style="color: #64748b;">Unggah teks, file PDF & video YouTube</p>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm bg-white text-center p-3 rounded-3">
            <div class="d-inline-flex align-items-center justify-content-center bg-warning bg-opacity-10 text-warning rounded-circle mb-2 mx-auto" style="width: 44px; height: 44px;">
                <span class="fw-bold fs-5">3</span>
            </div>
            <h6 class="fw-bold mb-1 text-dark">Buat Tugas</h6>
            <p class="small mb-0 fw-medium" style="color: #64748b;">Tentukan instruksi & batas tenggat</p>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm bg-white text-center p-3 rounded-3">
            <div class="d-inline-flex align-items-center justify-content-center bg-info bg-opacity-10 text-info rounded-circle mb-2 mx-auto" style="width: 44px; height: 44px;">
                <span class="fw-bold fs-5">4</span>
            </div>
            <h6 class="fw-bold mb-1 text-dark">Nilai & Rekap</h6>
            <p class="small mb-0 fw-medium" style="color: #64748b;">Evaluasi jawaban & pantau progres</p>
        </div>
    </div>
</div>

<!-- Detailed Guide Accordion / Sections -->
<div class="row">
    <div class="col-lg-8 mb-4">
        
        {{-- Section 1: Kelola Data Siswa --}}
        <div class="card border-0 shadow-sm mb-3 rounded-3 overflow-hidden">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 bg-primary bg-opacity-10 text-primary rounded-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <h5 class="fw-bold mb-0 text-dark">1. Panduan Pengelolaan Data Siswa</h5>
                </div>
                <a href="{{ route('guru.siswa.index') }}" class="btn btn-sm btn-light text-primary fw-bold">Buka Menu &rarr;</a>
            </div>
            <div class="card-body p-4">
                <p class="mb-3 fw-medium" style="color: #334155;">Guru memiliki wewenang penuh untuk mendaftarkan dan memelihara akun siswa kelas X SMK Negeri 1 Rao Selatan.</p>
                <div class="ps-2">
                    <div class="d-flex mb-3">
                        <div class="fw-bold text-primary me-2 fs-6">A.</div>
                        <div>
                            <strong class="text-dark d-block mb-1 fs-6">Menambah Siswa Baru:</strong>
                            <span class="d-block" style="color: #334155; line-height: 1.6;">Buka menu <strong>Data Siswa</strong> $\rightarrow$ klik tombol <strong>"Tambah Siswa"</strong>. Isi data wajib berupa NISN, Nama Lengkap, Kelas (misal: <em>X-1 / X-2</em>), Username, dan Password awal siswa.</span>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="fw-bold text-primary me-2 fs-6">B.</div>
                        <div>
                            <strong class="text-dark d-block mb-1 fs-6">Mengedit Data & Reset Password:</strong>
                            <span class="d-block" style="color: #334155; line-height: 1.6;">Klik tombol <strong>Edit (Ikon Pensil)</strong> pada baris siswa yang bersangkutan. Jika siswa lupa password, ketikkan password baru pada form edit untuk memperbaruinya.</span>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="fw-bold text-primary me-2 fs-6">C.</div>
                        <div>
                            <strong class="text-dark d-block mb-1 fs-6">Menghapus Siswa:</strong>
                            <span class="d-block" style="color: #334155; line-height: 1.6;">Klik tombol <strong>Hapus (Ikon Tong Sampah)</strong> jika data siswa sudah tidak aktif atau salah input. Seluruh riwayat pengumpulan tugas siswa terkait akan dibersihkan secara aman.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 2: Kelola Materi Pembelajaran --}}
        <div class="card border-0 shadow-sm mb-3 rounded-3 overflow-hidden">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 bg-success bg-opacity-10 text-success rounded-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10"/><path d="M6 10h10"/></svg>
                    </div>
                    <h5 class="fw-bold mb-0 text-dark">2. Panduan Mengelola Materi Belajar</h5>
                </div>
                <a href="{{ route('guru.materi.index') }}" class="btn btn-sm btn-light text-success fw-bold">Buka Menu &rarr;</a>
            </div>
            <div class="card-body p-4">
                <p class="mb-3 fw-medium" style="color: #334155;">Materi adalah bahan ajar interaktif untuk elemen Pemrograman Dasar DDPK.</p>
                <div class="ps-2">
                    <div class="d-flex mb-3">
                        <div class="fw-bold text-success me-2 fs-6">A.</div>
                        <div>
                            <strong class="text-dark d-block mb-1 fs-6">Membuat Materi Baru:</strong>
                            <span class="d-block" style="color: #334155; line-height: 1.6;">Buka menu <strong>Materi</strong> $\rightarrow$ klik tombol <strong>"Tambah Materi"</strong>. Masukkan judul materi dan deskripsi/isi pembelajaran yang jelas.</span>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="fw-bold text-success me-2 fs-6">B.</div>
                        <div>
                            <strong class="text-dark d-block mb-1 fs-6">Menyematkan Video Pembelajaran YouTube:</strong>
                            <span class="d-block" style="color: #334155; line-height: 1.6;">Tempelkan link/URL video YouTube pada kolom <em>Link Video</em>. Sistem akan secara otomatis menampilkan pemutar video interaktif di halaman siswa.</span>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="fw-bold text-success me-2 fs-6">C.</div>
                        <div>
                            <strong class="text-dark d-block mb-1 fs-6">Mengunggah Dokumen / Modul PDF:</strong>
                            <span class="d-block" style="color: #334155; line-height: 1.6;">Lampirkan file bahan ajar (format PDF, DOCX, atau PPT) agar siswa dapat mengunduh dan membaca materi secara mandiri kapan saja.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 3: Kelola Tugas & Praktikum --}}
        <div class="card border-0 shadow-sm mb-3 rounded-3 overflow-hidden">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 bg-warning bg-opacity-10 text-warning rounded-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                    </div>
                    <h5 class="fw-bold mb-0 text-dark">3. Panduan Membuat Tugas & Latihan</h5>
                </div>
                <a href="{{ route('guru.tugas.index') }}" class="btn btn-sm btn-light text-warning fw-bold">Buka Menu &rarr;</a>
            </div>
            <div class="card-body p-4">
                <p class="mb-3 fw-medium" style="color: #334155;">Tugas digunakan untuk menguji pemahaman siswa terhadap elemen pemrograman yang dipelajari.</p>
                <div class="ps-2">
                    <div class="d-flex mb-3">
                        <div class="fw-bold text-warning me-2 fs-6">A.</div>
                        <div>
                            <strong class="text-dark d-block mb-1 fs-6">Membuat Tugas Baru:</strong>
                            <span class="d-block" style="color: #334155; line-height: 1.6;">Pilih menu <strong>Tugas</strong> $\rightarrow$ klik <strong>"Tambah Tugas"</strong>. Hubungkan tugas dengan materi yang relevan, masukkan judul, serta deskripsi perintah tugas.</span>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="fw-bold text-warning me-2 fs-6">B.</div>
                        <div>
                            <strong class="text-dark d-block mb-1 fs-6">Menentukan Tenggat Waktu (Deadline):</strong>
                            <span class="d-block" style="color: #334155; line-height: 1.6;">Atur tanggal dan jam batas akhir pengumpulan. Siswa yang mengumpulkan setelah batas waktu akan diberi penanda khusus agar memudahkan evaluasi kedisiplinan.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 4: Penilaian & Rekapitulasi Progres --}}
        <div class="card border-0 shadow-sm mb-3 rounded-3 overflow-hidden">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 bg-info bg-opacity-10 text-info rounded-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                    </div>
                    <h5 class="fw-bold mb-0 text-dark">4. Panduan Evaluasi Penilaian & Rekapitulasi</h5>
                </div>
                <a href="{{ route('guru.penilaian.index') }}" class="btn btn-sm btn-light text-info fw-bold">Buka Menu &rarr;</a>
            </div>
            <div class="card-body p-4">
                <p class="mb-3 fw-medium" style="color: #334155;">Fitur penilaian dan rekap mempermudah guru dalam memantau hasil belajar siswa secara transparan.</p>
                <div class="ps-2">
                    <div class="d-flex mb-3">
                        <div class="fw-bold text-info me-2 fs-6">A.</div>
                        <div>
                            <strong class="text-dark d-block mb-1 fs-6">Mengecek Jawaban & Unduh File:</strong>
                            <span class="d-block" style="color: #334155; line-height: 1.6;">Pada menu <strong>Penilaian</strong>, pilih tugas yang ingin dinilai. Klik tombol <strong>"Unduh Jawaban"</strong> untuk mengunduh kode program atau dokumen yang dikirimkan siswa.</span>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="fw-bold text-info me-2 fs-6">B.</div>
                        <div>
                            <strong class="text-dark d-block mb-1 fs-6">Memberikan Skor & Catatan Feedback:</strong>
                            <span class="d-block" style="color: #334155; line-height: 1.6;">Ketikkan nilai angka (0 - 100) dan berikan catatan evaluasi/saran perbaikan. Siswa dapat langsung membaca feedback ini pada dashboard mereka.</span>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="fw-bold text-info me-2 fs-6">C.</div>
                        <div>
                            <strong class="text-dark d-block mb-1 fs-6">Melihat Rekap Progres Belajar:</strong>
                            <span class="d-block" style="color: #334155; line-height: 1.6;">Buka menu <strong>Rekap Progres</strong> untuk melihat grafik ketuntasan kelas, persentase penyelesaian materi, dan rekapitulasi nilai seluruh siswa.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Sidebar Cards: FAQ & Tips Praktikalitas -->
    <div class="col-lg-4">
        
        <!-- Callout Tips Guru - Solid Crisp White Font -->
        <div class="card border-0 shadow-sm rounded-3 p-4 mb-4" style="background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%); color: #ffffff;">
            <div class="d-flex align-items-center gap-2 mb-3">
                <div class="bg-white bg-opacity-20 p-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v4"/><path d="M12 18v4"/><path d="M4.93 4.93l2.83 2.83"/><path d="M16.24 16.24l2.83 2.83"/><path d="M2 12h4"/><path d="M18 12h4"/><path d="M4.93 19.07l2.83-2.83"/><path d="M16.24 7.76l2.83-2.83"/></svg>
                </div>
                <h6 class="fw-bold mb-0 text-white fs-6">Tips Pembelajaran Efektif</h6>
            </div>
            <p class="mb-3 text-white fw-normal" style="line-height: 1.6; font-size: 0.93rem;">Manfaatkan media ini untuk menerapkan model pembelajaran <strong>Blended Learning</strong> atau pembelajaran mandiri berbasis proyek.</p>
            <ul class="ps-3 mb-0 text-white" style="line-height: 1.7; font-size: 0.9rem;">
                <li class="mb-2"><strong>Unggah modul</strong> 1 hari sebelum jam pelajaran dimulai.</li>
                <li class="mb-2"><strong>Berikan tugas bertingkat</strong> (dasar, menengah, studi kasus).</li>
                <li><strong>Gunakan kolom feedback</strong> untuk memotivasi siswa.</li>
            </ul>
        </div>

        <!-- FAQ Card -->
        <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
            <h6 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2 fs-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                Pertanyaan Umum (FAQ)
            </h6>
            
            <div class="mb-3 border-bottom pb-3">
                <strong class="text-dark d-block mb-1" style="font-size: 0.92rem;">Format file apa yang bisa diunggah guru?</strong>
                <p class="mb-0" style="color: #334155; font-size: 0.88rem; line-height: 1.5;">Guru dapat mengunggah file materi dalam format PDF, DOC, DOCX, dan PPT dengan ukuran file hingga 10MB.</p>
            </div>
            <div class="mb-3 border-bottom pb-3">
                <strong class="text-dark d-block mb-1" style="font-size: 0.92rem;">Apakah nilai tugas yang sudah diinput bisa diubah?</strong>
                <p class="mb-0" style="color: #334155; font-size: 0.88rem; line-height: 1.5;">Bisa. Guru dapat mengedit kembali nilai dan catatan feedback kapan saja melalui menu Penilaian.</p>
            </div>
            <div>
                <strong class="text-dark d-block mb-1" style="font-size: 0.92rem;">Bagaimana jika siswa lupa password?</strong>
                <p class="mb-0" style="color: #334155; font-size: 0.88rem; line-height: 1.5;">Guru dapat mengedit data siswa yang bersangkutan pada menu Data Siswa dan memasukkan password baru.</p>
            </div>
        </div>

        <!-- Info Dukungan -->
        <div class="card border-0 bg-light rounded-3 p-3 text-center">
            <p class="fw-medium mb-0" style="color: #475569; font-size: 0.85rem;">Media Pembelajaran Elemen Pemrograman DDPK<br><strong class="text-dark">SMK Negeri 1 Rao Selatan</strong></p>
        </div>

    </div>
</div>
@endsection
