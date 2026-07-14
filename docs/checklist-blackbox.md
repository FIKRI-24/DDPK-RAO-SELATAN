# Lembar Hasil Pengujian Sistem (Black-Box Testing)

Pengujian sistem dilakukan menggunakan metode *Black-Box Testing* untuk memverifikasi fungsionalitas tombol, validasi form, alur otorisasi multi-guard, dan manajemen file storage lokal secara offline. 

Seluruh pengujian dilaksanakan pada lingkungan server lokal (XAMPP/Vite) dengan status akhir **PASS (Lolos Uji)**.

---

## Tabel Checklist Pengujian Black-Box (35/35 PASS)

| No | Modul / Fitur yang Diuji | Skenario Pengujian | Hasil yang Diharapkan | Status |
|---|---|---|---|---|
| 1 | Autentikasi | Login sebagai Guru dengan memilih tipe "Guru" dan kredensial valid | Masuk ke sistem dan dialihkan ke `/guru/dashboard` | **PASS** |
| 2 | Autentikasi | Login sebagai Siswa dengan memilih tipe "Siswa" dan kredensial valid | Masuk ke sistem dan dialihkan ke `/siswa/dashboard` | **PASS** |
| 3 | Autentikasi | Logout dari panel Guru / Siswa | Sesi ditutup dengan aman dan dialihkan kembali ke `/login` | **PASS** |
| 4 | Otorisasi Keamanan | Siswa mencoba mengakses rute Guru secara manual (`/guru/dashboard` atau `/guru/materi`) | Akses ditolak oleh middleware `auth.guru` dan dialihkan ke `/login` | **PASS** |
| 5 | Otorisasi Keamanan | Guru mencoba mengakses rute Siswa secara manual (`/siswa/dashboard` atau `/siswa/tugas`) | Akses ditolak oleh middleware `auth.siswa` dan dialihkan ke `/login` | **PASS** |
| 6 | Kelola Materi (Guru) | Guru mengunggah materi baru tanpa mengisi berkas lampiran | Materi berhasil disimpan ke database dan muncul di tabel | **PASS** |
| 7 | Kelola Materi (Guru) | Guru mengunggah materi baru dengan melampirkan file PDF | Berkas tersimpan ke `storage/app/public/materi` dan path tercatat relatif di DB | **PASS** |
| 8 | Kelola Materi (Guru) | Guru mengedit judul dan deskripsi isi materi | Perubahan data teks ter-update secara instan di database | **PASS** |
| 9 | Kelola Materi (Guru) | Guru memperbarui materi dengan mengunggah file lampiran baru | File baru terunggah, dan file lampiran lama di server terhapus otomatis | **PASS** |
| 10 | Kelola Materi (Guru) | Guru menghapus baris materi pembelajaran | Baris data terhapus dari DB dan file lampiran terkait terhapus dari server | **PASS** |
| 11 | Baca Materi (Siswa) | Siswa membuka menu Materi pembelajaran | Tampil seluruh daftar materi dari semua guru secara read-only | **PASS** |
| 12 | Baca Materi (Siswa) | Siswa membuka halaman detail materi | Teks materi ter-format rapi dan tautan file lampiran dapat diunduh | **PASS** |
| 13 | Kelola Tugas (Guru) | Guru membuat tugas baru dan memilih materi miliknya | Tugas tersimpan ke DB dan terasosiasi dengan materi terkait | **PASS** |
| 14 | Kelola Tugas (Guru) | Guru memperbarui nama tugas dan instruksi pengerjaan | Data tugas berhasil diupdate di database | **PASS** |
| 15 | Kelola Tugas (Guru) | Guru menghapus tugas yang belum memiliki pengumpulan jawaban siswa | Tugas terhapus secara permanen dari database | **PASS** |
| 16 | Kelola Tugas (Guru) | Guru mencoba menghapus tugas yang sudah dikumpulkan oleh siswa | Penghapusan ditolak oleh controller, memicu alert error di halaman index | **PASS** |
| 17 | Tugas (Siswa) | Siswa membuka menu Tugas pembelajaran | Daftar tugas tampil dengan badge status (Belum / Sudah Dikumpulkan) | **PASS** |
| 18 | Tugas (Siswa) | Siswa mengunggah jawaban tugas (format ZIP/PDF) pertama kali | Berkas terunggah ke folder `jawaban` dan status berubah menjadi hijau | **PASS** |
| 19 | Tugas (Siswa) | Siswa mengunggah ulang (mereplace) jawaban tugas | Jawaban baru tersimpan, berkas jawaban lama di server terhapus otomatis | **PASS** |
| 20 | Penilaian (Guru) | Guru membuka menu Penilaian tugas | Daftar tugas tampil beserta statistik jumlah kumpul, dinilai, dan belum dinilai | **PASS** |
| 21 | Penilaian (Guru) | Guru menginput nilai angka (contoh: 85) pada berkas siswa | Nilai tersimpan ke database pada kolom `nilai` di tabel `hasil` | **PASS** |
| 22 | Penilaian (Guru) | Guru memperbarui nilai yang sudah diinput (contoh: dari 85 menjadi 90) | Nilai berhasil diupdate dan disimpan kembali ke database | **PASS** |
| 23 | Penilaian (Guru) | Guru menginput nilai di luar batas (seperti -5 atau 110) | Form memicu validasi error dan menolak input karena melanggar aturan min:0 max:100 | **PASS** |
| 24 | Rekap Progres (Guru) | Guru membuka menu Rekap Progres belajar | Rangkuman progres bar dan rata-rata nilai seluruh siswa tampil dinamis | **PASS** |
| 25 | Rekap Progres (Guru) | Guru melihat detail progres satu siswa secara mendalam | Riwayat status seluruh tugas guru login untuk siswa tersebut tampil lengkap | **PASS** |
| 26 | Nilai & Progres (Siswa) | Siswa membuka menu Nilai & Progres | Menampilkan persentase progress bar pengumpulan tugas dan nilai rata-rata privat | **PASS** |
| 27 | Dashboard Guru | Memeriksa nilai widget statistik setelah penambahan data | Widget Jumlah Materi, Tugas, Siswa, dan Tugas Dikumpul terhitung akurat | **PASS** |
| 28 | Dashboard Siswa | Memeriksa widget statistik di panel siswa | Widget materi tersedia, total tugas, status tugas, dan rata-rata nilai cocok | **PASS** |
| 29 | UI Responsif | Window browser dikecilkan ke resolusi layar HP (mobile view) | Sidebar otomatis tersembunyi dan tombol menu toggle (hamburger) aktif | **PASS** |
| 30 | Keamanan CSRF | Memeriksa kode HTML form login, materi, tugas, dan nilai | Semua form menyertakan input token tersembunyi `@csrf` untuk mencegah CSRF | **PASS** |
| 31 | Konfirmasi Tindakan | Guru mengeklik tombol Hapus pada materi atau tugas | Muncul jendela konfirmasi dialog javascript sebelum data dihapus | **PASS** |
| 32 | Validasi Upload | Guru/Siswa mengunggah file berukuran di atas 5 MB | File ditolak otomatis oleh validator laravel dan memicu pesan kesalahan | **PASS** |
| 33 | Validasi Format | Guru/Siswa mengunggah berkas dengan format ilegal (seperti .exe, .html) | File ditolak otomatis oleh sistem demi menjaga keamanan web server | **PASS** |
| 34 | Unduh Berkas | Mengeklik tombol buka/unduh berkas materi atau berkas jawaban | File terunduh dan terbuka dengan sukses melalui tautan storage link publik | **PASS** |
| 35 | Tampilan Kosong | Membuka daftar tabel materi/tugas ketika database dalam keadaan kosong | Halaman memuat empty state yang rapi disertai emoji dan petunjuk teks | **PASS** |
