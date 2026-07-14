# Panduan Penggunaan Aplikasi — Panel Siswa

Dokumen ini berisi panduan deskriptif langkah demi langkah untuk mengoperasikan panel Siswa pada sistem Media Pembelajaran Elemen Pemrograman Dasar DDPK.

---

## 1. Login Siswa
1. Akses halaman login aplikasi melalui web browser (misal: `http://localhost:8000/login`).
2. Masukkan kredensial login Anda pada form:
   * **Login Sebagai**: Pilih pilihan **Siswa** pada dropdown.
   * **Username**: Masukkan username Anda (contoh: `siswa1`).
   * **Password**: Masukkan password Anda (contoh: `password123`).
3. Klik tombol **Login**. Jika berhasil, Anda akan dialihkan ke Dashboard Siswa.

---

## 2. Memahami Dashboard Siswa
Setelah masuk, Anda dapat melihat ringkasan status belajar pribadi Anda secara langsung pada card widget:
* **Materi Tersedia**: Total materi pembelajaran pemrograman dasar yang telah diunggah oleh seluruh Guru.
* **Tugas Tersedia**: Jumlah tugas yang wajib Anda perhatikan atau kerjakan.
* **Sudah Dikumpul**: Jumlah tugas yang telah sukses Anda kirimkan jawabannya.
* **Belum Dikumpul**: Jumlah tugas tersisa yang belum Anda serahkan jawabannya.
* **Sudah Dinilai**: Jumlah pengerjaan tugas Anda yang telah diperiksa dan dinilai oleh Guru.
* **Rata-rata Nilai**: Rata-rata nilai akademis Anda saat ini (hanya menghitung tugas yang sudah diberi nilai oleh Guru).

---

## 3. Membaca Materi Pembelajaran
1. Klik menu **Materi** pada sidebar sebelah kiri.
2. Anda akan disajikan daftar materi ajar dalam bentuk kartu (*cards*). Masing-masing kartu menampilkan judul, nama guru pembuat, tanggal upload, dan kutipan singkat isi materi.
3. Klik tombol **Baca Materi** pada salah satu materi.
4. Anda dapat membaca uraian lengkap isi materi tersebut secara mandiri di layar.
5. Jika Guru menyertakan file lampiran (seperti dokumen PDF/PPT), Anda dapat mengunduhnya dengan mengeklik tombol **Buka / Unduh File** di bagian bawah isi materi.

---

## 4. Melihat & Mengerjakan Tugas
1. Klik menu **Tugas** pada sidebar sebelah kiri.
2. Anda akan melihat seluruh daftar tugas yang diberikan.
3. Perhatikan badge status di setiap tugas:
   * Badge kuning **⏳ Belum Dikumpulkan** menandakan Anda belum menyerahkan jawaban.
   * Badge hijau **✔️ Sudah Dikumpulkan** menandakan Anda telah mengumpulkan berkas jawaban.
4. Klik tombol **Lihat & Kumpulkan** pada tugas yang ingin Anda kerjakan untuk melihat detail petunjuk tugas yang diberikan oleh Guru.

---

## 5. Mengumpulkan Jawaban Tugas
1. Pada halaman Detail Tugas, baca dengan teliti petunjuk pengerjaan di bagian kiri.
2. Perhatikan status pengumpulan Anda di panel sebelah kanan.
3. Untuk mengunggah jawaban pertama kali:
   * Klik tombol **Choose File / Pilih File** pada form pilih file jawaban.
   * Pilih berkas jawaban dari komputer Anda. Pastikan format berkas didukung (.pdf, .zip, .rar, .doc, .docx, dsb.) dengan ukuran berkas maksimal **5 MB**.
   * Klik tombol **Kirim Jawaban**.
   * Status pengumpulan Anda otomatis berubah menjadi hijau **"Sudah Dikumpulkan"**.

---

## 6. Memperbarui (Mengunggah Ulang) Berkas Jawaban
Jika Anda menyadari adanya kesalahan pada jawaban yang dikirim dan ingin menggantinya dengan file revisi baru sebelum dinilai oleh Guru:
1. Masuk kembali ke detail tugas bersangkutan.
2. Pada form pengumpulan sebelah kanan, pilih file jawaban baru Anda.
3. Klik tombol **Perbarui Jawaban**.
> ℹ️ *Sistem akan otomatis mengunggah file baru Anda ke server dan menghapus file jawaban lama Anda secara permanen untuk menjaga kerapian direktori penyimpanan.*

---

## 7. Memantau Nilai dan Progres Belajar Pribadi
Untuk melacak kemandirian belajar Anda secara menyeluruh:
1. Klik menu **Nilai & Progres** pada sidebar sebelah kiri.
2. Di bagian atas halaman, Anda dapat melihat **progress bar persentase** yang melacak sejauh mana Anda telah mengumpulkan seluruh tugas yang ada.
3. Anda juga dapat melihat kotak nilai rata-rata Anda yang berwarna biru.
4. Tabel rincian di bawah menampilkan daftar tugas lengkap dengan statusnya (Belum Dikumpulkan/Sudah Dikumpulkan/Sudah Dinilai).
5. Jika tugas berstatus **"Sudah Dinilai"**, Anda dapat melihat nilai numerik Anda pada kolom paling kanan.
6. Klik tombol **Detail** pada baris tugas terkait untuk melihat file jawaban yang Anda kumpulkan sebelumnya beserta catatan nilai evaluasi dari Guru.

---

## 8. Logout
Setelah selesai belajar, klik tombol **Logout** (tombol outline merah) di sudut kanan atas navbar untuk menutup sesi belajar Anda dengan aman demi keamanan akun Anda.
