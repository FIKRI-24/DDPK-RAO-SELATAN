# PRD — Media Pembelajaran Berbasis Web Elemen Pemrograman Dasar DDPK

**Klien:** Muhammad Alfisahri  
**NPM:** 2201100075  
**Lokasi Penelitian:** SMK Negeri 1 Rao Selatan  
**Program Studi:** Pendidikan Informatika, UPGRISBA  
**Judul Proposal:** Pengembangan Media Pembelajaran Berbasis Web pada Elemen Pemrograman Mata Pelajaran DDPK di Kelas X SMK Negeri 1 Rao Selatan  
**Metodologi Penelitian:** Research and Development dengan model Waterfall  
**Stack Wajib:** Laravel, HTML, CSS Bootstrap, JavaScript, MySQL/phpMyAdmin, XAMPP

---

## 1. Ringkasan Produk

Sistem yang dikembangkan adalah **media pembelajaran berbasis web** untuk mata pelajaran **Dasar-Dasar Program Keahlian (DDPK)** pada elemen **Pemrograman Dasar** kelas X SMK Negeri 1 Rao Selatan.

Sistem ini digunakan oleh dua aktor utama, yaitu **Guru** dan **Siswa**. Fokus utama sistem adalah membantu guru dalam membagikan materi, memberikan tugas, memeriksa tugas, dan mengelola hasil belajar siswa. Sementara itu, siswa dapat mengakses materi, mengerjakan tugas, mengunggah jawaban, serta melihat nilai dan progres belajar pribadi.

Produk ini disiapkan untuk mendukung pengujian skripsi klien, yaitu pengujian kevalidan, kepraktisan, dan efektivitas media pembelajaran berbasis web.

---

## 2. Tujuan Produk

Tujuan produk adalah menghasilkan sistem media pembelajaran berbasis web yang:

1. Mempermudah guru dalam menyampaikan materi Pemrograman Dasar.
2. Mempermudah guru dalam membuat dan mengelola tugas.
3. Mempermudah siswa dalam mengakses materi secara mandiri.
4. Mempermudah siswa dalam mengumpulkan tugas secara online.
5. Mempermudah guru dalam memberi nilai tugas siswa.
6. Menampilkan progres belajar siswa berdasarkan tugas, status pengumpulan, dan nilai.
7. Mendukung kebutuhan validasi ahli materi, validasi ahli media, angket praktikalitas, dan angket kemandirian belajar siswa.

---

## 3. Aktor dan Hak Akses

| Aktor | Hak Akses |
|---|---|
| **Guru** | Login, dashboard guru, kelola materi, kelola tugas, melihat pengumpulan tugas siswa, memberi/edit nilai, melihat rekap nilai dan progres seluruh siswa |
| **Siswa** | Login, dashboard siswa, melihat materi, membaca detail materi, melihat tugas, mengunggah jawaban tugas, melihat status pengumpulan, melihat nilai dan progres belajar sendiri |

**Catatan desain penting:**  
Sistem tetap menggunakan dua tabel terpisah, yaitu `guru` dan `siswa`, bukan satu tabel `users` dengan role. Ini dibuat agar selaras dengan rancangan database pada proposal klien. Untuk implementasi Laravel, autentikasi dapat menggunakan **multi-guard**: `auth:guru` dan `auth:siswa`.

---

## 4. Ruang Lingkup MVP

MVP sistem wajib mencakup:

1. Login dan logout guru/siswa.
2. Dashboard guru dan siswa.
3. CRUD materi oleh guru.
4. Akses materi oleh siswa.
5. CRUD tugas oleh guru.
6. Pengumpulan tugas oleh siswa.
7. Penilaian tugas oleh guru.
8. Tampilan nilai dan progres belajar siswa.
9. Rekap nilai/progres siswa untuk guru.
10. Pengujian Black Box untuk fitur utama.

Fitur di luar MVP:

1. Integrasi Google Drive.
2. Notifikasi real-time.
3. Chat atau forum diskusi.
4. Editor kode online.
5. Ujian online otomatis.

---

## 5. Functional Requirements

### FR-1 Autentikasi

| Kode | Kebutuhan |
|---|---|
| FR-1.1 | Guru dapat login menggunakan username dan password. |
| FR-1.2 | Siswa dapat login menggunakan username dan password. |
| FR-1.3 | Sistem mengarahkan guru ke dashboard guru setelah login berhasil. |
| FR-1.4 | Sistem mengarahkan siswa ke dashboard siswa setelah login berhasil. |
| FR-1.5 | Jika username/password salah, sistem menampilkan pesan error. |
| FR-1.6 | Guru dan siswa dapat logout. |
| FR-1.7 | Halaman guru hanya dapat diakses oleh guru. |
| FR-1.8 | Halaman siswa hanya dapat diakses oleh siswa. |

### FR-2 Dashboard Guru

| Kode | Kebutuhan |
|---|---|
| FR-2.1 | Guru melihat jumlah materi yang sudah dibuat. |
| FR-2.2 | Guru melihat jumlah tugas yang sudah dibuat. |
| FR-2.3 | Guru melihat jumlah siswa terdaftar. |
| FR-2.4 | Guru melihat ringkasan tugas yang sudah/belum dikumpulkan siswa. |
| FR-2.5 | Guru dapat mengakses menu materi, tugas, penilaian, dan rekap progres. |

### FR-3 Dashboard Siswa

| Kode | Kebutuhan |
|---|---|
| FR-3.1 | Siswa melihat daftar materi terbaru. |
| FR-3.2 | Siswa melihat daftar tugas yang harus dikerjakan. |
| FR-3.3 | Siswa melihat jumlah tugas yang sudah dikumpulkan. |
| FR-3.4 | Siswa melihat jumlah tugas yang belum dikumpulkan. |
| FR-3.5 | Siswa melihat ringkasan nilai/progres pribadi. |

### FR-4 Kelola Materi oleh Guru

| Kode | Kebutuhan |
|---|---|
| FR-4.1 | Guru dapat menambah materi. |
| FR-4.2 | Data materi terdiri dari judul, isi materi, dan file materi opsional. |
| FR-4.3 | Guru dapat mengunggah file materi seperti PDF, DOC, DOCX, PPT, atau gambar. |
| FR-4.4 | Guru dapat melihat daftar materi yang sudah dibuat. |
| FR-4.5 | Guru dapat mengedit materi. |
| FR-4.6 | Guru dapat menghapus materi. |
| FR-4.7 | Sistem menyimpan tanggal upload materi. |

### FR-5 Akses Materi oleh Siswa

| Kode | Kebutuhan |
|---|---|
| FR-5.1 | Siswa dapat melihat daftar materi yang tersedia. |
| FR-5.2 | Siswa dapat membuka detail materi. |
| FR-5.3 | Siswa dapat membaca isi materi. |
| FR-5.4 | Siswa dapat mengunduh atau membuka file materi jika tersedia. |

### FR-6 Kelola Tugas oleh Guru

| Kode | Kebutuhan |
|---|---|
| FR-6.1 | Guru dapat membuat tugas. |
| FR-6.2 | Tugas dapat dikaitkan dengan materi tertentu. |
| FR-6.3 | Data tugas terdiri dari nama tugas dan deskripsi/instruksi tugas. |
| FR-6.4 | Guru dapat melihat daftar tugas. |
| FR-6.5 | Guru dapat mengedit tugas. |
| FR-6.6 | Guru dapat menghapus tugas. |

### FR-7 Pengumpulan Tugas oleh Siswa

| Kode | Kebutuhan |
|---|---|
| FR-7.1 | Siswa dapat melihat daftar tugas yang tersedia. |
| FR-7.2 | Siswa dapat membuka detail tugas. |
| FR-7.3 | Siswa dapat mengunggah file jawaban tugas. |
| FR-7.4 | Sistem menyimpan file jawaban tugas ke storage lokal Laravel. |
| FR-7.5 | Sistem mencatat tanggal pengumpulan tugas. |
| FR-7.6 | Siswa dapat melihat status tugas: belum dikumpulkan, sudah dikumpulkan, atau sudah dinilai. |
| FR-7.7 | Jika siswa sudah mengumpulkan tugas, sistem dapat menampilkan file jawaban yang sudah dikirim. |

### FR-8 Penilaian Tugas oleh Guru

| Kode | Kebutuhan |
|---|---|
| FR-8.1 | Guru dapat melihat daftar pengumpulan tugas siswa. |
| FR-8.2 | Guru dapat membuka/mengunduh file jawaban siswa. |
| FR-8.3 | Guru dapat memasukkan nilai tugas siswa. |
| FR-8.4 | Guru dapat mengedit nilai yang sudah diberikan. |
| FR-8.5 | Nilai dapat bernilai 0–100. |
| FR-8.6 | Nilai boleh kosong/null ketika tugas baru dikumpulkan dan belum dinilai. |

### FR-9 Progres dan Nilai Siswa

| Kode | Kebutuhan |
|---|---|
| FR-9.1 | Siswa dapat melihat daftar nilai tugas. |
| FR-9.2 | Siswa dapat melihat tugas yang sudah dinilai. |
| FR-9.3 | Siswa dapat melihat tugas yang belum dinilai. |
| FR-9.4 | Siswa dapat melihat tugas yang belum dikumpulkan. |
| FR-9.5 | Siswa dapat melihat rata-rata nilai pribadi. |
| FR-9.6 | Sistem menampilkan progres belajar berdasarkan jumlah tugas selesai dibanding total tugas. |

### FR-10 Rekap Progres Guru

| Kode | Kebutuhan |
|---|---|
| FR-10.1 | Guru dapat melihat daftar seluruh siswa. |
| FR-10.2 | Guru dapat melihat jumlah tugas yang sudah dikumpulkan setiap siswa. |
| FR-10.3 | Guru dapat melihat jumlah tugas yang belum dikumpulkan setiap siswa. |
| FR-10.4 | Guru dapat melihat rata-rata nilai setiap siswa. |
| FR-10.5 | Guru dapat melihat detail nilai siswa per tugas. |

---

## 6. Non-Functional Requirements

| Kode | Kebutuhan |
|---|---|
| NFR-1 | Sistem mudah digunakan oleh guru dan siswa. |
| NFR-2 | Tampilan menggunakan Bootstrap dan responsif di desktop maupun mobile. |
| NFR-3 | Navigasi sederhana dan menu mudah dipahami. |
| NFR-4 | Password disimpan menggunakan hash Laravel/bcrypt. |
| NFR-5 | Semua form menggunakan proteksi CSRF Laravel. |
| NFR-6 | File upload divalidasi berdasarkan tipe dan ukuran file. |
| NFR-7 | Sistem berjalan di XAMPP lokal menggunakan MySQL/phpMyAdmin. |
| NFR-8 | Sistem stabil saat pengujian alpha dan beta. |
| NFR-9 | Struktur halaman mendukung penilaian ahli media dari aspek tampilan, navigasi, fungsionalitas, dan responsivitas. |
| NFR-10 | Konten materi mendukung validasi ahli materi dari aspek kesesuaian isi, penyajian, kebahasaan, dan manfaat pembelajaran. |

---

## 7. Skema Database Final yang Disarankan

### 7.1 Tabel `siswa`

```text
siswa
  id_siswa      BIGINT PK
  nisn          VARCHAR(30)
  nama          VARCHAR(100)
  kelas         VARCHAR(50)
  username      VARCHAR(50) UNIQUE
  password      VARCHAR(255)
  created_at    TIMESTAMP NULL
  updated_at    TIMESTAMP NULL
```

### 7.2 Tabel `guru`

```text
guru
  id_guru       BIGINT PK
  nip           VARCHAR(30)
  nama          VARCHAR(100)
  username      VARCHAR(50) UNIQUE
  password      VARCHAR(255)
  created_at    TIMESTAMP NULL
  updated_at    TIMESTAMP NULL
```

### 7.3 Tabel `materi`

```text
materi
  id_materi     BIGINT PK
  id_guru       BIGINT FK -> guru.id_guru
  judul         VARCHAR(150)
  isi_materi    TEXT
  file_materi   VARCHAR(255) NULL
  tgl_upload    TIMESTAMP NULL
  created_at    TIMESTAMP NULL
  updated_at    TIMESTAMP NULL
```

### 7.4 Tabel `tugas`

```text
tugas
  id_tugas      BIGINT PK
  id_materi     BIGINT FK -> materi.id_materi
  nama_tugas    VARCHAR(150)
  deskripsi     TEXT NULL
  created_at    TIMESTAMP NULL
  updated_at    TIMESTAMP NULL
```

### 7.5 Tabel `hasil`

```text
hasil
  id_hasil      BIGINT PK
  id_tugas      BIGINT FK -> tugas.id_tugas
  id_siswa      BIGINT FK -> siswa.id_siswa
  file_jawaban  VARCHAR(255) NULL
  nilai         INTEGER NULL
  tgl_kumpul    TIMESTAMP NULL
  created_at    TIMESTAMP NULL
  updated_at    TIMESTAMP NULL
```

### Catatan Sinkronisasi Bab III

Pada proposal awal, tabel `hasil` hanya mencantumkan data nilai. Namun secara kebutuhan sistem, fitur pengumpulan tugas membutuhkan kolom `file_jawaban` dan `tgl_kumpul`. Oleh karena itu, struktur Bab III sebaiknya diperbarui agar sesuai dengan sistem final.

Kolom tambahan yang perlu dikonfirmasi kepada klien/pembimbing:

| Tabel | Kolom Tambahan | Alasan |
|---|---|---|
| `siswa` | `username`, `password` | Diperlukan untuk login siswa |
| `guru` | `username`, `password` | Diperlukan untuk login guru |
| `materi` | `file_materi`, `tgl_upload` | Diperlukan untuk upload dan pencatatan materi |
| `tugas` | `deskripsi` | Diperlukan untuk instruksi tugas |
| `hasil` | `file_jawaban`, `tgl_kumpul` | Diperlukan untuk pengumpulan tugas siswa |

---

## 8. Penyimpanan File

Untuk versi MVP dan pengujian skripsi, sistem menggunakan **storage lokal Laravel**:

```text
storage/app/public/materi
storage/app/public/jawaban
```

File dapat diakses melalui perintah:

```bash
php artisan storage:link
```

Integrasi Google Drive tidak dimasukkan ke MVP karena dapat menambah kompleksitas OAuth dan tidak menjadi inti fitur utama yang diuji. Namun, karena proposal menyebut kemungkinan penyimpanan berbasis cloud, Google Drive tetap dicatat sebagai fitur pengembangan lanjutan.

---

## 9. Mapping Fitur ke Instrumen Penelitian

| Instrumen Penelitian | Aspek yang Dinilai | Fitur Sistem yang Mendukung |
|---|---|---|
| Validasi Ahli Materi | Kesesuaian materi, kelengkapan, penyajian, bahasa, manfaat media | Halaman materi, detail materi, file materi |
| Validasi Ahli Media | Tampilan, navigasi, fungsionalitas, responsivitas, kualitas teknis | Dashboard, menu guru/siswa, Bootstrap responsive, login, materi, tugas |
| Praktikalitas Guru | Kemudahan guru menggunakan media | CRUD materi, CRUD tugas, penilaian, rekap progres |
| Praktikalitas Siswa | Kemudahan siswa menggunakan media | Akses materi, lihat tugas, upload jawaban, lihat nilai |
| Kemandirian Belajar | Inisiatif belajar, tanggung jawab, percaya diri, pemecahan masalah, disiplin waktu | Materi online, tugas online, status pengumpulan, progres belajar pribadi |

---

## 10. Mapping ke Model Waterfall

| Tahap Waterfall Proposal | Implementasi pada Proyek |
|---|---|
| Analisis Kebutuhan | Analisis proposal, kebutuhan guru/siswa, fitur materi, tugas, hasil belajar |
| Desain Sistem | Use Case Diagram, Activity Diagram, Sequence Diagram, Class Diagram, ERD, rancangan UI |
| Implementasi | Coding Laravel, migration, seeder, controller, route, Blade view, Bootstrap UI |
| Pengujian | Black Box Testing login, materi, tugas, pengumpulan, nilai, progres |
| Pemeliharaan | Perbaikan bug dari hasil validasi, respons guru/siswa, dan pengujian sistem |

---

## 11. Struktur Fase Pengembangan Teknis

### Fase 1 — Setup dan Fondasi

Output:

1. Project Laravel dibuat.
2. `.env` dikonfigurasi ke MySQL XAMPP.
3. Database dibuat di phpMyAdmin.
4. Migration tabel `siswa`, `guru`, `materi`, `tugas`, dan `hasil`.
5. Model dan relasi antar tabel dibuat.
6. Seeder data dummy guru dan siswa.
7. Setup storage lokal Laravel.
8. Setup multi-guard auth guru dan siswa.

### Fase 2 — Autentikasi dan Dashboard

Output:

1. Halaman login.
2. Login guru.
3. Login siswa.
4. Logout guru/siswa.
5. Middleware proteksi route guru.
6. Middleware proteksi route siswa.
7. Dashboard guru.
8. Dashboard siswa.

### Fase 3 — Modul Materi

Output:

1. CRUD materi untuk guru.
2. Upload file materi.
3. Daftar materi guru.
4. Daftar materi siswa.
5. Detail materi siswa.
6. Download/lihat file materi.

### Fase 4 — Modul Tugas dan Pengumpulan

Output:

1. CRUD tugas oleh guru.
2. Tugas terhubung dengan materi.
3. Daftar tugas siswa.
4. Detail tugas siswa.
5. Upload jawaban tugas siswa.
6. Status tugas: belum dikumpulkan/sudah dikumpulkan.

### Fase 5 — Modul Penilaian dan Progres

Output:

1. Daftar pengumpulan tugas siswa.
2. Guru dapat melihat file jawaban.
3. Guru input/edit nilai.
4. Siswa melihat nilai.
5. Siswa melihat progres pribadi.
6. Guru melihat rekap progres seluruh siswa.

### Fase 6 — Testing dan Perbaikan

Output:

1. Black Box Testing login guru.
2. Black Box Testing login siswa.
3. Black Box Testing kelola materi.
4. Black Box Testing akses materi.
5. Black Box Testing kelola tugas.
6. Black Box Testing upload jawaban.
7. Black Box Testing input nilai.
8. Black Box Testing tampilan progres.
9. Uji responsivitas desktop dan mobile.
10. Perbaikan bug.

### Fase 7 — Dokumentasi dan Handover

Output:

1. Dokumentasi struktur database.
2. Dokumentasi akun login dummy.
3. Manual penggunaan guru.
4. Manual penggunaan siswa.
5. Checklist pengujian sistem.
6. Mapping fitur ke Bab III.
7. Backup source code dan database.

---

## 12. Dokumen Desain yang Perlu Disiapkan

Karena proposal membahas UML dan perancangan sistem, proyek sebaiknya juga menghasilkan dokumen pendukung berikut:

1. Use Case Diagram Guru dan Siswa.
2. Activity Diagram Login.
3. Activity Diagram Kelola Materi.
4. Activity Diagram Kelola Tugas.
5. Activity Diagram Pengumpulan Tugas.
6. Activity Diagram Penilaian.
7. Sequence Diagram Login.
8. Sequence Diagram Pengumpulan Tugas.
9. Sequence Diagram Penilaian.
10. Class Diagram atau ERD final.
11. Rancangan database final.
12. Rancangan tampilan dashboard guru dan siswa.

---

## 13. Acceptance Criteria

Sistem dianggap siap untuk pengujian skripsi apabila:

1. Guru berhasil login dan logout.
2. Siswa berhasil login dan logout.
3. Guru dapat menambah, mengedit, menghapus, dan melihat materi.
4. Siswa dapat melihat dan membaca materi.
5. Guru dapat membuat, mengedit, menghapus, dan melihat tugas.
6. Siswa dapat mengunggah jawaban tugas.
7. Sistem menampilkan status pengumpulan tugas.
8. Guru dapat melihat jawaban siswa.
9. Guru dapat memberi dan mengedit nilai.
10. Siswa dapat melihat nilai sendiri.
11. Guru dapat melihat rekap nilai/progres siswa.
12. Tampilan responsif di laptop dan HP.
13. Tidak ada error utama saat fitur diuji.
14. Database sesuai dengan struktur yang sudah disepakati.
15. Fitur dapat dipetakan ke instrumen validasi, praktikalitas, dan kemandirian belajar.

---

## 14. Catatan Risiko dan Konfirmasi ke Klien

Sebelum coding dimulai, konfirmasi poin berikut kepada klien:

1. **Tabel Bab III perlu diperbarui.**  
   Kolom `username`, `password`, `file_materi`, `deskripsi`, `file_jawaban`, dan `tgl_kumpul` perlu ditambahkan agar sistem final sesuai kebutuhan nyata.

2. **Upload jawaban tugas disimpan di tabel `hasil`.**  
   Tabel `hasil` berfungsi sebagai tabel pengumpulan tugas sekaligus tabel nilai. Ketika siswa upload jawaban, sistem membuat atau memperbarui data `hasil` dengan `nilai = null` sampai dinilai guru.

3. **Google Drive ditunda.**  
   Untuk versi pengujian, file disimpan di storage lokal Laravel. Google Drive dicatat sebagai fitur lanjutan apabila pembimbing mewajibkan.

4. **Tidak perlu fitur terlalu besar.**  
   Sistem fokus pada kebutuhan proposal: materi, tugas, hasil belajar, validasi, praktikalitas, dan kemandirian belajar.

---

## 15. Aturan Implementasi untuk Codex

Gunakan aturan ini saat nanti diberikan ke Codex:

```text
Bangun sistem Laravel sesuai PRD ini. Jangan ubah stack teknologi. Gunakan Laravel, Blade, Bootstrap, JavaScript sederhana, MySQL, dan XAMPP. Gunakan tabel guru dan siswa terpisah, bukan tabel users dengan role. Gunakan multi-guard auth untuk guru dan siswa. Fokus pada fitur MVP: login, dashboard, materi, tugas, pengumpulan tugas, penilaian, nilai, dan progres. Gunakan storage lokal Laravel untuk upload file. Jangan implementasikan Google Drive dulu. Jangan menambahkan fitur di luar PRD tanpa konfirmasi.
```

---

## 16. Kesimpulan

PRD ini sudah diperbarui dan aman untuk dijadikan dasar kerja. Fokusnya sesuai proposal: **media pembelajaran berbasis web untuk materi Pemrograman Dasar, pemberian tugas, pengumpulan tugas, nilai, dan progres belajar siswa**.

Bagian yang paling penting untuk dikunci sebelum coding adalah persetujuan klien bahwa Bab III boleh disesuaikan pada struktur tabel, terutama penambahan `username`, `password`, `file_materi`, `file_jawaban`, dan `tgl_kumpul`.
