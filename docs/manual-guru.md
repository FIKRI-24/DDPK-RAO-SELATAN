# Panduan Penggunaan Aplikasi — Panel Guru

Dokumen ini berisi panduan deskriptif langkah demi langkah untuk mengoperasikan panel Guru pada sistem Media Pembelajaran Elemen Pemrograman Dasar DDPK.

---

## 1. Login Guru
1. Buka browser dan akses alamat aplikasi (misal: `http://localhost:8000/login`).
2. Pada form login yang tersedia:
   * **Login Sebagai**: Pilih pilihan **Guru** pada dropdown.
   * **Username**: Masukkan username Guru Anda (dummy: `guru`).
   * **Password**: Masukkan password Anda (dummy: `password123`).
3. Klik tombol **Login**. Jika berhasil, sistem akan mengarahkan Anda ke Dashboard Guru.

---

## 2. Memahami Dashboard Guru
Setelah login berhasil, Anda akan melihat halaman ringkasan data statistik yang dihitung berdasarkan materi ajar milik Anda sendiri:
* **Jumlah Materi**: Total materi yang telah Anda unggah.
* **Jumlah Tugas**: Total tugas pembelajaran yang telah Anda buat.
* **Jumlah Siswa**: Jumlah seluruh siswa yang terdaftar di dalam sistem.
* **Tugas Dikumpulkan**: Jumlah berkas jawaban tugas buatan Anda yang telah dikirimkan oleh siswa.
* **Belum Dinilai**: Jumlah berkas jawaban masuk dari siswa yang perlu diperiksa dan belum diberikan nilai.

---

## 3. Mengelola Materi Pembelajaran
Untuk masuk ke pengelolaan materi, klik menu **Materi** pada sidebar sebelah kiri.

### A. Menambahkan Materi Ajar Baru
1. Pada halaman Daftar Materi, klik tombol **+ Tambah Materi** di sudut kanan atas.
2. Isi formulir yang disediakan:
   * **Judul Materi**: Tulis judul bahasan materi pemrograman (contoh: "Logika Percabangan IF-ELSE").
   * **Isi Materi**: Tulis uraian penjelasan materi secara detail.
   * **File Lampiran (Opsional)**: Anda dapat mengunggah file pendukung (berkas PDF, presentasi PPT, atau gambar pendukung) dengan ukuran maksimal 5 MB.
3. Klik tombol **Simpan**.

### B. Mengubah (Edit) Materi
1. Pada tabel Daftar Materi, klik tombol **Edit** pada baris materi yang ingin diperbarui.
2. Lakukan perubahan pada judul, isi teks, atau ganti file lampiran lama dengan mengunggah file baru.
3. Klik tombol **Perbarui**.
> ℹ️ *Sistem akan otomatis menghapus file materi lama dari penyimpanan server apabila Anda mengunggah file materi baru untuk menghemat kapasitas.*

### C. Menghapus Materi
1. Pada tabel Daftar Materi, klik tombol **Hapus** pada baris materi yang bersangkutan.
2. Klik **OK** pada jendela konfirmasi yang muncul. Materi beserta file lampirannya di server akan terhapus permanen.

---

## 4. Mengelola Tugas Pembelajaran
Klik menu **Tugas** pada sidebar sebelah kiri untuk masuk ke panel pengelolaan tugas.

### A. Menambahkan Tugas Baru
1. Klik tombol **+ Tambah Tugas**.
2. Isi data tugas:
   * **Materi Terkait**: Pilih materi ajar Anda yang mendasari tugas ini pada pilihan dropdown.
   * **Nama Tugas**: Tulis nama tugas (contoh: "Latihan Alur Logika Percabangan").
   * **Petunjuk / Deskripsi Tugas**: Masukkan instruksi pengerjaan tugas dengan jelas untuk siswa.
3. Klik **Simpan Tugas**.

### B. Mengubah & Menghapus Tugas
* Untuk mengubah petunjuk tugas, klik tombol **Edit** pada baris tugas terkait, lakukan perubahan, lalu simpan.
* Untuk menghapus tugas, klik tombol **Hapus** dan konfirmasi tindakan Anda.
> ⚠️ **Catatan Penting**: Sistem akan menolak penghapusan tugas jika sudah ada minimal satu siswa yang mengumpulkan jawaban ke tugas tersebut demi menjaga keutuhan data nilai siswa.

---

## 5. Menilai Jawaban Tugas Siswa
Untuk memberikan evaluasi nilai terhadap hasil pekerjaan siswa:
1. Klik menu **Penilaian** pada sidebar kiri. Anda akan melihat daftar tugas Anda beserta informasi status jumlah siswa yang sudah mengumpulkan dan yang sudah dinilai.
2. Klik tombol **Evaluasi Jawaban** pada tugas yang ingin dinilai.
3. Anda akan melihat daftar siswa yang telah mengunggah jawabannya.
4. Klik tombol **Unduh** pada kolom file jawaban untuk mendownload berkas jawaban (.zip, .pdf, dsb.) siswa tersebut ke komputer Anda untuk diperiksa.
5. Klik tombol **Beri Nilai** (atau **Edit Nilai** jika ingin mengubah nilai lama) pada baris nama siswa bersangkutan.
6. Masukkan angka nilai evaluasi antara **0 hingga 100** pada form input yang disediakan.
7. Klik **Simpan Nilai**.

---

## 6. Memantau Rekap Progres Siswa
Untuk melihat pencapaian seluruh siswa secara kolektif:
1. Klik menu **Rekap Progres** pada sidebar kiri.
2. Anda akan disajikan tabel berisi seluruh siswa terdaftar beserta progress bar persentase pengumpulan tugas mereka (berdasarkan tugas buatan Anda) dan nilai rata-rata mereka.
3. Klik tombol **Detail Progres** pada baris siswa tertentu untuk melihat riwayat lengkap pengerjaan tugas siswa tersebut (status kumpul, lampiran berkas, tanggal pengumpulan, serta rincian nilai per tugas).

---

## 7. Logout
Apabila Anda telah selesai menggunakan aplikasi, klik tombol **Logout** berwarna merah di sudut kanan atas navbar untuk menutup sesi aman Anda.
