# Media Pembelajaran Berbasis Web Elemen Pemrograman Dasar DDPK

Aplikasi ini merupakan sistem Media Pembelajaran Berbasis Web untuk Elemen Pemrograman Dasar pada mata pelajaran Dasar-Dasar Program Keahlian (DDPK) Teknik Jaringan Komputer dan Telekomunikasi (TJKT). Sistem ini dirancang untuk mempermudah penyajian materi pembelajaran, pemberian tugas, pengumpulan jawaban siswa secara digital, serta pemantauan rekapitulasi progres belajar siswa secara real-time.

---

## Stack Teknologi

Sistem dibangun menggunakan kombinasi stack teknologi modern yang ramah untuk dijalankan pada infrastruktur server lokal (XAMPP/offline):
* **Backend Framework**: Laravel 11.x (PHP 8.2+)
* **Frontend Library**: Bootstrap 5 (Terintegrasi secara lokal via npm/Vite, 100% offline ready)
* **Scripting Language**: Vanilla JavaScript (untuk interaksi interaktif UI)
* **Database**: MySQL / MariaDB (melalui phpMyAdmin lokal)
* **Web Server Lokal**: Apache (XAMPP)

---

## Fitur Utama

### 1. Panel Guru (Guru Pengampu)
* **Dashboard Statistik**: Memantau jumlah materi, jumlah tugas, total siswa terdaftar, tugas terkumpul, dan berkas jawaban masuk yang belum dinilai.
* **Kelola Materi**: Mengunggah, mengedit, memperbarui file lampiran (PDF/Gambar), dan menghapus materi ajar secara mandiri (terproteksi hak kepemilikan materi).
* **Kelola Tugas**: Membuat dan mengedit tugas pembelajaran yang dikaitkan dengan materi ajar miliknya sendiri.
* **Penilaian Tugas**: Melihat daftar pengumpulan jawaban siswa, mengunduh file jawaban, serta menginput atau mengubah nilai evaluasi (skala 0 - 100).
* **Rekap Progres**: Memantau grafik persentase pengumpulan tugas dan rata-rata pencapaian nilai bagi seluruh siswa.

### 2. Panel Siswa (Peserta Didik)
* **Dashboard Progres**: Memantau status belajar pribadi, seperti jumlah materi tersedia, total tugas, tugas yang sudah/belum dikumpulkan, jumlah tugas dinilai, dan rata-rata nilai.
* **Membaca Materi**: Mengakses materi ajar yang dipublikasikan oleh para guru dan mengunduh berkas lampirannya.
* **Kumpul Tugas**: Melihat instruksi tugas, mengunggah file jawaban, serta melakukan perbaikan jawaban (replace file) secara mandiri.
* **Nilai & Progres**: Melihat daftar riwayat tugas lengkap dengan status pengumpulan, nilai evaluasi, dan rata-rata nilai akhir secara privat.

---

## Persyaratan Sistem (Prerequisites)

Untuk menjalankan proyek ini di komputer lokal, pastikan Anda telah menginstal perangkat lunak berikut:
1. **XAMPP** (versi PHP 8.2 atau lebih tinggi)
2. **Composer** (untuk mengelola dependensi PHP Laravel)
3. **Node.js** (versi 20.x atau 22.x, untuk build Bootstrap lokal via Vite)
4. **Web Browser** (Google Chrome, Microsoft Edge, atau Mozilla Firefox)

---

## Langkah Instalasi & Konfigurasi Lokal

Ikuti langkah-langkah di bawah ini untuk memasang proyek dari awal:

### 1. Kloning Repositori
Jika Anda mengunduh dari GitHub, silakan kloning repositori ini terlebih dahulu ke dalam direktori server lokal Anda (misal `htdocs` untuk XAMPP atau `www` untuk Laragon):
```bash
git clone https://github.com/FIKRI-24/DDPK-RAO-SELATAN.git ddpk-rao-selatan
cd ddpk-rao-selatan
```

### 2. Instal Dependensi Composer
Instal semua package dependensi PHP Laravel yang diperlukan dengan menjalankan perintah:
```bash
composer install
```

### 3. Konfigurasi File Lingkungan (.env)
1. Salin file `.env.example` dan ubah namanya menjadi `.env`:
   * **Windows (CMD/PowerShell)**:
     ```bash
     copy .env.example .env
     ```
   * **Linux/macOS**:
     ```bash
     cp .env.example .env
     ```
2. Buka file `.env` yang baru dibuat di root folder proyek menggunakan text editor, lalu pastikan pengaturan database terisi sesuai dengan konfigurasi lokal Anda:
   ```env
   APP_NAME="Media Pembelajaran DDPK"
   APP_ENV=local
   APP_DEBUG=true
   APP_URL=http://localhost:8000

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=ddpk_rao_selatan
   DB_USERNAME=root
   DB_PASSWORD=

   SESSION_DRIVER=file
   CACHE_STORE=file
   QUEUE_CONNECTION=sync
   FILESYSTEM_DISK=local
   ```

### 4. Generate Application Key
Jalankan perintah berikut untuk menggenerasikan key keamanan aplikasi Laravel yang baru ke dalam file `.env`:
```bash
php artisan key:generate
```

### 5. Buat Database MySQL
1. Jalankan panel kontrol XAMPP / Laragon Anda, kemudian aktifkan modul **Apache** dan **MySQL**.
2. Buka browser dan akses halaman `http://localhost/phpmyadmin`.
3. Buat database baru bernama `ddpk_rao_selatan` dengan collation default (`utf8mb4_general_ci`).

### 6. Jalankan Migrasi dan Pengisian Data Awal (Seeder)
Untuk membuat struktur tabel database dan mengisi data akun guru & siswa demo pertama kali, jalankan perintah:
```bash
php artisan migrate --seed
```
> ⚠️ **Catatan Penting**: Perintah `php artisan migrate:fresh --seed` dapat digunakan jika ingin membersihkan ulang database. Namun, **jangan** jalankan perintah fresh setelah sistem mulai digunakan untuk pengujian asli, karena perintah tersebut akan menghapus semua data materi, tugas, dan jawaban siswa yang telah diinput sebelumnya.

### 7. Instal Dependensi Node.js & Build Aset
Jalankan perintah berikut untuk mengunduh package Bootstrap lokal dan melakukan kompilasi aset frontend menggunakan Vite:
```bash
npm install
npm run build
```

### 8. Hubungkan Storage Link (Sangat Penting)
Jalankan perintah berikut agar berkas/file materi ajar dan file jawaban siswa yang diunggah dapat diakses dan diunduh secara publik oleh browser:
```bash
php artisan storage:link
```

---

## Cara Menjalankan Aplikasi

1. Buka terminal (CMD/PowerShell) di folder proyek, kemudian jalankan web server lokal Laravel:
   ```bash
   php artisan serve
   ```
2. Aplikasi akan berjalan di alamat `http://127.0.0.1:8000` (atau `http://localhost:8000`). Buka browser Anda dan akses alamat tersebut. Anda akan diarahkan otomatis ke halaman login.

---

## Akun Demo Pengujian

Gunakan akun dummy berikut untuk masuk ke sistem:

### 1. Akun Guru
* **Username**: `guru`
* **Password**: `password123`

### 2. Akun Siswa
* **Siswa 1**: Username `siswa1`, Password `password123`
* **Siswa 2**: Username `siswa2`, Password `password123`
* **Siswa 3**: Username `siswa3`, Password `password123`
