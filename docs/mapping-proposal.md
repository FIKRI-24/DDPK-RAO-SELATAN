# Pemetaan Fitur Aplikasi terhadap Kebutuhan Proposal / Skripsi

Dokumen ini disusun untuk mempermudah pemetaan (*mapping*) fungsionalitas sistem Media Pembelajaran Elemen Pemrograman Dasar DDPK ke dalam variabel-variabel penelitian tindakan kelas, skripsi, atau laporan tugas akhir.

---

## 1. Penyajian Materi Pembelajaran secara Mandiri
* **Tujuan Penelitian**: Menganalisis efektivitas visualisasi materi ajar pemrograman dasar terhadap pemahaman konsep siswa.
* **Fitur Terkait**: 
  - **Penyajian Materi Terstruktur**: Guru dapat membagi materi ajar menjadi bab-bab terpisah (Tabel `materi`).
  - **Dukungan Multimedia**: Guru dapat mengunggah file pelengkap (presentasi PPT, modul PDF, dan gambar kode program) secara langsung tanpa perantara eksternal.
  - **Akses Siswa (Offline Ready)**: Siswa dapat membaca teks materi dan mengunduh berkas materi secara lokal.

---

## 2. Pemberian & Evaluasi Tugas Mandiri
* **Tujuan Penelitian**: Meningkatkan kedisiplinan dan keterampilan menulis kode (*coding*) melalui penugasan terstruktur.
* **Fitur Terkait**:
  - **Relasi Tugas-Materi**: Tugas dikaitkan langsung dengan bab materi yang relevan (Tabel `tugas` ber-relasi ke `materi`).
  - **Instruksi Tugas Detail**: Guru dapat menuliskan teks instruksi pengerjaan yang lengkap dan ter-format baris.

---

## 3. Digitalisasi Pengumpulan Tugas (Paperless)
* **Tujuan Penelitian**: Mengurangi kendala administrasi pengumpulan tugas lokal di kelas dan meminimalkan resiko berkas hilang.
* **Fitur Terkait**:
  - **Pengunggahan Berkas**: Siswa mengunggah jawaban tugas langsung melalui browser dalam format `.zip` (project source code), `.pdf`, atau gambar screenshot.
  - **Revisi Jawaban Mandiri**: Siswa dapat mengunggah ulang jawaban untuk menimpa file jawaban usang (sistem menangani penghapusan otomatis berkas lama di server server-side untuk efisiensi ruang).

---

## 4. Pengelolaan Nilai & Evaluasi Belajar (Feedback Loop)
* **Tujuan Penelitian**: Memberikan umpan balik penilaian belajar yang instan untuk memacu motivasi belajar.
* **Fitur Terkait**:
  - **Panel Penilaian Guru**: Guru dapat memeriksa daftar pengumpulan siswa, mengunduh file jawaban, dan langsung menginput nilai numerik skala 0-100 (Tabel `hasil`).
  - **Riwayat Nilai Privat**: Siswa dapat langsung melihat nilai tugas yang telah dinilai oleh guru secara privat demi kerahasiaan data nilai.

---

## 5. Pemantauan Progres Belajar & Kemandirian Belajar
* **Tujuan Penelitian**: Menerapkan evaluasi berbasis proses untuk melatih kemandirian belajar siswa (Self-Regulated Learning).
* **Fitur Terkait**:
  - **Progress Bar Siswa**: Siswa dapat memantau persentase penyelesaian tugas secara visual melalui grafik batang progres belajar.
  - **Widget Rata-rata Nilai**: Menampilkan nilai rata-rata kumulatif yang ter-update otomatis begitu guru memberi nilai.
  - **Rekapitulasi Progres Guru**: Guru dapat melihat tabel ringkasan progres pengerjaan tugas seluruh siswa beserta rata-rata kelas untuk mengidentifikasi siswa yang lambat belajar.

---

## 6. Praktikalitas & Validasi Sistem (Metode R&D)
Aplikasi ini sangat mendukung metode penelitian pengembangan (Research and Development / R&D), khususnya pada tahap pengujian kelayakan:
* **Validasi Ahli Media**: Melalui pengujian struktur UI responsif Bootstrap 5, efisiensi ukuran berkas (batas maksimal 5 MB), kemudahan navigasi sidebar, dan keutuhan sesi multi-guard.
* **Praktikalitas Guru & Siswa**: Melalui kuesioner respon guru dan siswa terhadap efisiensi waktu distribusi materi, pengumpulan tugas, dan kejelasan visualisasi nilai.
* **Pengujian Sistem Black-Box**: Telah diuji dengan 35 skenario pengujian fungsionalitas dan keamanan (Fase 6) dengan tingkat kelolosan **100% (PASS)** untuk membuktikan keandalan sistem tanpa error/bug.
