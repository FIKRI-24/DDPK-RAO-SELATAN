@extends('layouts.app')

@section('title', 'Petunjuk Penggunaan Siswa - Media Pembelajaran DDPK')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <span class="text-uppercase text-primary small fw-bold tracking-wider">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="me-1"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            Panduan Belajar Mandiri
        </span>
        <h2 class="fw-bold mb-1 text-dark">Petunjuk Penggunaan Media Siswa</h2>
        <p class="text-dark fw-medium mb-0" style="color: #475569 !important;">Pelajari cara mudah mengakses modul materi pemrograman, mengumpulkan tugas, dan melihat perkembangan nilaimu.</p>
    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <a href="{{ route('siswa.dashboard') }}" class="btn btn-outline-secondary btn-sm fw-semibold">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Kembali ke Dashboard
        </a>
    </div>
</div>

<!-- 4 Langkah Mudah Belajar di Media DDPK -->
<div class="row mb-4 g-3">
    <div class="col-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm bg-white text-center p-3 rounded-3">
            <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle mb-2 mx-auto" style="width: 44px; height: 44px;">
                <span class="fw-bold fs-5">1</span>
            </div>
            <h6 class="fw-bold mb-1 text-dark">Pelajari Materi</h6>
            <p class="small mb-0 fw-medium" style="color: #64748b;">Baca modul & tonton video penjelasan</p>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm bg-white text-center p-3 rounded-3">
            <div class="d-inline-flex align-items-center justify-content-center bg-warning bg-opacity-10 text-warning rounded-circle mb-2 mx-auto" style="width: 44px; height: 44px;">
                <span class="fw-bold fs-5">2</span>
            </div>
            <h6 class="fw-bold mb-1 text-dark">Kerjakan Tugas</h6>
            <p class="small mb-0 fw-medium" style="color: #64748b;">Ketik kode program atau file jawaban</p>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm bg-white text-center p-3 rounded-3">
            <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success rounded-circle mb-2 mx-auto" style="width: 44px; height: 44px;">
                <span class="fw-bold fs-5">3</span>
            </div>
            <h6 class="fw-bold mb-1 text-dark">Upload Jawaban</h6>
            <p class="small mb-0 fw-medium" style="color: #64748b;">Unggah file sebelum batas deadline</p>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm bg-white text-center p-3 rounded-3">
            <div class="d-inline-flex align-items-center justify-content-center bg-info bg-opacity-10 text-info rounded-circle mb-2 mx-auto" style="width: 44px; height: 44px;">
                <span class="fw-bold fs-5">4</span>
            </div>
            <h6 class="fw-bold mb-1 text-dark">Cek Nilai & Progres</h6>
            <p class="small mb-0 fw-medium" style="color: #64748b;">Lihat skor & masukan dari Guru</p>
        </div>
    </div>
</div>

<!-- Detail Panduan Siswa -->
<div class="row">
    <div class="col-lg-8 mb-4">
        
        {{-- Langkah 1: Membaca & Mempelajari Materi --}}
        <div class="card border-0 shadow-sm mb-3 rounded-3 overflow-hidden">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 bg-primary bg-opacity-10 text-primary rounded-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10"/><path d="M6 10h10"/></svg>
                    </div>
                    <h5 class="fw-bold mb-0 text-dark">1. Cara Mempelajari Materi Pemrograman</h5>
                </div>
                <a href="{{ route('siswa.materi.index') }}" class="btn btn-sm btn-light text-primary fw-bold">Buka Materi &rarr;</a>
            </div>
            <div class="card-body p-4">
                <div class="ps-2">
                    <div class="d-flex mb-3">
                        <div class="fw-bold text-primary me-2 fs-6">A.</div>
                        <div>
                            <strong class="text-dark d-block mb-1 fs-6">Membuka Daftar Materi:</strong>
                            <span class="d-block" style="color: #334155; line-height: 1.6;">Klik menu <strong>Materi</strong> pada sidebar sebelah kiri. Di sana kamu akan melihat daftar seluruh modul elemen pemrograman dasar yang telah disiapkan oleh Guru.</span>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="fw-bold text-primary me-2 fs-6">B.</div>
                        <div>
                            <strong class="text-dark d-block mb-1 fs-6">Membaca Modul & Menonton Video:</strong>
                            <span class="d-block" style="color: #334155; line-height: 1.6;">Klik pada salah satu materi. Kamu dapat membaca uraian teks, memutar video tutorial interaktif YouTube yang disematkan, serta mengunduh berkas materi (PDF/dokumen) untuk dibaca secara luring (offline).</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Langkah 2: Mengerjakan & Mengunggah Tugas --}}
        <div class="card border-0 shadow-sm mb-3 rounded-3 overflow-hidden">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 bg-warning bg-opacity-10 text-warning rounded-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                    </div>
                    <h5 class="fw-bold mb-0 text-dark">2. Cara Mengerjakan & Mengunggah Tugas</h5>
                </div>
                <a href="{{ route('siswa.tugas.index') }}" class="btn btn-sm btn-light text-warning fw-bold">Buka Tugas &rarr;</a>
            </div>
            <div class="card-body p-4">
                <div class="ps-2">
                    <div class="d-flex mb-3">
                        <div class="fw-bold text-warning me-2 fs-6">A.</div>
                        <div>
                            <strong class="text-dark d-block mb-1 fs-6">Cek Batas Waktu (Deadline):</strong>
                            <span class="d-block" style="color: #334155; line-height: 1.6;">Buka menu <strong>Tugas</strong>. Perhatikan tanggal dan jam batas akhir pengumpulan pada setiap kartu tugas agar tugasmu tidak terlambat dikumpulkan.</span>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="fw-bold text-warning me-2 fs-6">B.</div>
                        <div>
                            <strong class="text-dark d-block mb-1 fs-6">Mengunggah File Jawaban:</strong>
                            <span class="d-block" style="color: #334155; line-height: 1.6;">Klik tombol <strong>"Kumpulkan Jawaban"</strong>. Pilih berkas tugasmu dari HP atau Laptop (format yang didukung: <code>.pdf</code>, <code>.docx</code>, <code>.zip</code>, atau <code>.rar</code> dengan ukuran maksimal 10MB), lalu klik <strong>"Kirim Tugas"</strong>.</span>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="fw-bold text-warning me-2 fs-6">C.</div>
                        <div>
                            <strong class="text-dark d-block mb-1 fs-6">Status Pengumpulan:</strong>
                            <span class="d-block" style="color: #334155; line-height: 1.6;">Setelah berhasil terkirim, status tugasmu akan berubah menjadi <span class="badge bg-success">Sudah Dikumpulkan</span> atau <span class="badge bg-secondary">Menunggu Penilaian</span>.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Langkah 3: Melihat Nilai & Catatan Guru --}}
        <div class="card border-0 shadow-sm mb-3 rounded-3 overflow-hidden">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 bg-success bg-opacity-10 text-success rounded-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                    </div>
                    <h5 class="fw-bold mb-0 text-dark">3. Cara Melihat Nilai & Evaluasi Guru</h5>
                </div>
                <a href="{{ route('siswa.nilai.index') }}" class="btn btn-sm btn-light text-success fw-bold">Buka Nilai &rarr;</a>
            </div>
            <div class="card-body p-4">
                <div class="ps-2">
                    <div class="d-flex mb-3">
                        <div class="fw-bold text-success me-2 fs-6">A.</div>
                        <div>
                            <strong class="text-dark d-block mb-1 fs-6">Mengecek Skor Nilai:</strong>
                            <span class="d-block" style="color: #334155; line-height: 1.6;">Buka menu <strong>Nilai & Progres</strong>. Di sini kamu dapat melihat rekap skor nilai untuk setiap tugas yang telah diperiksa oleh Guru.</span>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="fw-bold text-success me-2 fs-6">B.</div>
                        <div>
                            <strong class="text-dark d-block mb-1 fs-6">Membaca Masukan & Saran Guru:</strong>
                            <span class="d-block" style="color: #334155; line-height: 1.6;">Guru biasanya memberikan catatan feedback perbaikan pada tugasmu. Baca saran tersebut untuk meningkatkan pemahaman coding dan logika pemrogramanmu!</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Sidebar Info & Tips Siswa -->
    <div class="col-lg-4">
        
        <!-- Banner Motivasi Siswa - Solid Crisp White Font -->
        <div class="card border-0 shadow-sm rounded-3 p-4 mb-4" style="background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%); color: #ffffff;">
            <div class="d-flex align-items-center gap-2 mb-3">
                <div class="bg-white bg-opacity-20 p-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                </div>
                <h6 class="fw-bold mb-0 text-white fs-6">Tips Sukses Belajar DDPK</h6>
            </div>
            <p class="mb-3 text-white fw-normal" style="line-height: 1.6; font-size: 0.93rem;">Pemrograman dasar membutuhkan latihan rutin dan ketelitian logika.</p>
            <ul class="ps-3 mb-0 text-white" style="line-height: 1.7; font-size: 0.9rem;">
                <li class="mb-2"><strong>Tonton video penjelasan</strong> kode program hingga tuntas.</li>
                <li class="mb-2"><strong>Praktikkan langsung</strong> variabel dan algoritma sederhana.</li>
                <li class="mb-2"><strong>Kumpulkan tugas</strong> sebelum batas tenggat waktu.</li>
                <li><strong>Jangan ragu bertanya</strong> jika ada materi yang belum dipahami!</li>
            </ul>
        </div>

        <!-- FAQ Siswa -->
        <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
            <h6 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2 fs-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                Pertanyaan Siswa (FAQ)
            </h6>
            
            <div class="mb-3 border-bottom pb-3">
                <strong class="text-dark d-block mb-1" style="font-size: 0.92rem;">Bagaimana jika file tugas saya terlalu besar?</strong>
                <p class="mb-0" style="color: #334155; font-size: 0.88rem; line-height: 1.5;">Kamu dapat mengompres file tugas menjadi format <code>.zip</code> atau <code>.rar</code>, atau menyimpannya dalam format PDF.</p>
            </div>
            <div class="mb-3 border-bottom pb-3">
                <strong class="text-dark d-block mb-1" style="font-size: 0.92rem;">Apakah saya bisa mengubah file tugas yang sudah terkirim?</strong>
                <p class="mb-0" style="color: #334155; font-size: 0.88rem; line-height: 1.5;">Selama tugas belum dinilai oleh Guru dan masih dalam batas waktu, kamu dapat mengunggah ulang file jawaban baru.</p>
            </div>
            <div>
                <strong class="text-dark d-block mb-1" style="font-size: 0.92rem;">Lupa password akun siswa?</strong>
                <p class="mb-0" style="color: #334155; font-size: 0.88rem; line-height: 1.5;">Silakan hubungi Guru Pengampu mata pelajaran DDPK untuk melakukan reset password akunmu.</p>
            </div>
        </div>

        <!-- Info Kelas & Sekolah -->
        <div class="card border-0 bg-light rounded-3 p-3 text-center">
            <p class="fw-medium mb-0" style="color: #475569; font-size: 0.85rem;">Kelas X - Elemen Pemrograman Dasar<br><strong class="text-dark">SMK Negeri 1 Rao Selatan</strong></p>
        </div>

    </div>
</div>
@endsection
