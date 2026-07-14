# Dokumentasi Struktur Database

Sistem Media Pembelajaran Pemrograman Dasar DDPK ini menggunakan basis data relasional MySQL. Untuk mendukung arsitektur otentikasi multi-guard yang mandiri dan aman, data **Guru** dan **Siswa** disimpan dalam dua tabel fisik terpisah, bukan dalam satu tabel dengan kolom peran (*role*).

---

## Diagram Hubungan Entitas (ERD Sederhana)

```text
  [ guru ] (id_guru)
     │
     └───hasMany───> [ materi ] (id_materi)
                        │
                        └───hasMany───> [ tugas ] (id_tugas)
                                           │
                                           └───hasMany───> [ hasil ] (id_hasil)
                                                              ^
                                                              │
                                                           hasMany
                                                              │
                                                        [ siswa ] (id_siswa)
```

---

## Rincian Kamus Data Tabel

### 1. Tabel `guru`
Tabel ini digunakan untuk menyimpan data otentikasi dan profil guru pengampu.

* **Primary Key**: `id_guru`
* **Definisi Kolom**:

| Nama Kolom | Tipe Data | Nullable | Deskripsi |
|---|---|---|---|
| `id_guru` | BigInt unsigned | No | ID unik Guru (Auto Increment) |
| `nip` | String (255) | Yes | Nomor Induk Pegawai Guru |
| `nama` | String (255) | No | Nama lengkap Guru pengampu |
| `username` | String (255) | No | Username login unik |
| `password` | String (255) | No | Password ter-enkripsi (Laravel Hash BCRYPT) |
| `created_at` | Timestamp | Yes | Waktu data baris dibuat |
| `updated_at` | Timestamp | Yes | Waktu data baris terakhir diubah |

---

### 2. Tabel `siswa`
Tabel ini menyimpan data otentikasi dan profil siswa peserta didik.

* **Primary Key**: `id_siswa`
* **Definisi Kolom**:

| Nama Kolom | Tipe Data | Nullable | Deskripsi |
|---|---|---|---|
| `id_siswa` | BigInt unsigned | No | ID unik Siswa (Auto Increment) |
| `nisn` | String (255) | Yes | Nomor Induk Siswa Nasional |
| `nama` | String (255) | No | Nama lengkap Siswa |
| `kelas` | String (255) | No | Kelas Siswa (contoh: X-1, X-2) |
| `username` | String (255) | No | Username login unik |
| `password` | String (255) | No | Password ter-enkripsi (Laravel Hash BCRYPT) |
| `created_at` | Timestamp | Yes | Waktu data baris dibuat |
| `updated_at` | Timestamp | Yes | Waktu data baris terakhir diubah |

---

### 3. Tabel `materi`
Tabel ini menyimpan seluruh materi pembelajaran yang diunggah oleh Guru.

* **Primary Key**: `id_materi`
* **Foreign Key**: `id_guru` (terhubung ke tabel `guru` dengan aksi `cascade` saat dihapus)
* **Definisi Kolom**:

| Nama Kolom | Tipe Data | Nullable | Deskripsi |
|---|---|---|---|
| `id_materi` | BigInt unsigned | No | ID unik Materi (Auto Increment) |
| `id_guru` | BigInt unsigned | No | Foreign Key relasi ke Guru pengunggah |
| `judul` | String (255) | No | Judul materi pembelajaran |
| `isi_materi` | Text | No | Naskah/Isi lengkap materi pembelajaran |
| `file_materi` | String (255) | Yes | Path relatif berkas lampiran materi di storage |
| `tgl_upload` | Timestamp | Yes | Tanggal materi dipublikasikan |
| `created_at` | Timestamp | Yes | Waktu data baris dibuat |
| `updated_at` | Timestamp | Yes | Waktu data baris terakhir diubah |

---

### 4. Tabel `tugas`
Tabel ini digunakan untuk menampung instrumen tugas belajar yang dikaitkan ke suatu materi.

* **Primary Key**: `id_tugas`
* **Foreign Key**: `id_materi` (terhubung ke tabel `materi` dengan aksi `cascade` saat dihapus)
* **Definisi Kolom**:

| Nama Kolom | Tipe Data | Nullable | Deskripsi |
|---|---|---|---|
| `id_tugas` | BigInt unsigned | No | ID unik Tugas (Auto Increment) |
| `id_materi` | BigInt unsigned | No | Foreign Key relasi ke materi terkait |
| `nama_tugas` | String (255) | No | Judul atau nama tugas |
| `deskripsi` | Text | Yes | Petunjuk instruksi pengerjaan tugas |
| `created_at` | Timestamp | Yes | Waktu data baris dibuat |
| `updated_at` | Timestamp | Yes | Waktu data baris terakhir diubah |

---

### 5. Tabel `hasil`
Tabel ini berfungsi sebagai tabel transaksi pengumpulan (*submission*) jawaban siswa sekaligus menampung nilai akhir dari guru.

* **Primary Key**: `id_hasil`
* **Foreign Keys**:
  * `id_tugas` (terhubung ke tabel `tugas` dengan aksi `cascade`)
  * `id_siswa` (terhubung ke tabel `siswa` dengan aksi `cascade`)
* **Definisi Kolom**:

| Nama Kolom | Tipe Data | Nullable | Deskripsi |
|---|---|---|---|
| `id_hasil` | BigInt unsigned | No | ID unik hasil pengumpulan (Auto Increment) |
| `id_tugas` | BigInt unsigned | No | Foreign Key tugas terkait |
| `id_siswa` | BigInt unsigned | No | Foreign Key siswa pengumpul |
| `file_jawaban` | String (255) | Yes | Path relatif berkas zip/pdf jawaban di storage |
| `nilai` | Integer | Yes | Nilai tugas (skala 0-100, null jika belum dinilai) |
| `tgl_kumpul` | Timestamp | Yes | Tanggal siswa mengirimkan berkas jawaban |
| `created_at` | Timestamp | Yes | Waktu data baris dibuat |
| `updated_at` | Timestamp | Yes | Waktu data baris terakhir diubah |

---

## Catatan Tambahan Implementasi Kolom Kustom

1. **username & password (Tabel guru & siswa)**: Disediakan secara mandiri di kedua tabel terpisah untuk memungkinkan Laravel melakukan otentikasi multi-guard menggunakan provider `guru` (Model Guru) dan `siswa` (Model Siswa) tanpa tergantung pada tabel bawaan Laravel (`users`).
2. **file_materi (Tabel materi)**: Menyimpan path berkas secara relatif terhadap folder `storage/app/public/` (misalnya: `materi/namafile.pdf`). Hal ini mempermudah migrasi server karena path absolut lokal tidak disimpan langsung di database.
3. **file_jawaban (Tabel hasil)**: Menyimpan path berkas pengumpulan jawaban siswa (misalnya: `jawaban/filejawaban.zip`).
4. **tgl_kumpul (Tabel hasil)**: Digunakan untuk mencatat waktu persis penyerahan berkas jawaban guna melacak ketepatan waktu belajar siswa secara mandiri.
