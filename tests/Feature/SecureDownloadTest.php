<?php

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Materi;
use App\Models\Tugas;
use App\Models\Hasil;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('local');
});

test('guest cannot download homework files', function () {
    $guru = Guru::create([
        'nip' => '123456789012345678',
        'nama' => 'Guru 1',
        'username' => 'guru1',
        'password' => Hash::make('password'),
    ]);

    $siswa1 = Siswa::create([
        'nisn' => '1111111111',
        'nama' => 'Siswa 1',
        'kelas' => 'X-1',
        'username' => 'siswa1',
        'password' => Hash::make('password'),
    ]);

    $materi = Materi::create([
        'id_guru' => $guru->id_guru,
        'judul' => 'Materi 1',
        'isi_materi' => 'Konten materi 1',
        'tgl_upload' => now(),
    ]);

    $tugas = Tugas::create([
        'id_materi' => $materi->id_materi,
        'nama_tugas' => 'Tugas 1',
        'deskripsi' => 'Deskripsi tugas 1',
    ]);

    Storage::disk('local')->put('jawaban/siswa1_jawaban.txt', 'Jawaban Siswa 1');

    $hasil = Hasil::create([
        'id_tugas' => $tugas->id_tugas,
        'id_siswa' => $siswa1->id_siswa,
        'file_jawaban' => 'jawaban/siswa1_jawaban.txt',
        'tgl_kumpul' => now(),
    ]);

    $response = $this->get(route('jawaban.unduh', $hasil->id_hasil));
    $response->assertStatus(401);
});

test('student cannot download another student\'s homework', function () {
    // 1. Create Gurus and Siswas
    $guru = Guru::create([
        'nip' => '123456789012345678',
        'nama' => 'Guru 1',
        'username' => 'guru1',
        'password' => Hash::make('password'),
    ]);

    $siswa1 = Siswa::create([
        'nisn' => '1111111111',
        'nama' => 'Siswa 1',
        'kelas' => 'X-1',
        'username' => 'siswa1',
        'password' => Hash::make('password'),
    ]);

    $siswa2 = Siswa::create([
        'nisn' => '2222222222',
        'nama' => 'Siswa 2',
        'kelas' => 'X-1',
        'username' => 'siswa2',
        'password' => Hash::make('password'),
    ]);

    // 2. Create Materi & Tugas
    $materi = Materi::create([
        'id_guru' => $guru->id_guru,
        'judul' => 'Materi 1',
        'isi_materi' => 'Konten materi 1',
        'tgl_upload' => now(),
    ]);

    $tugas = Tugas::create([
        'id_materi' => $materi->id_materi,
        'nama_tugas' => 'Tugas 1',
        'deskripsi' => 'Deskripsi tugas 1',
    ]);

    // 3. Store dummy file in local disk
    Storage::disk('local')->put('jawaban/siswa1_jawaban.txt', 'Jawaban Siswa 1');

    $hasil = Hasil::create([
        'id_tugas' => $tugas->id_tugas,
        'id_siswa' => $siswa1->id_siswa,
        'file_jawaban' => 'jawaban/siswa1_jawaban.txt',
        'tgl_kumpul' => now(),
    ]);

    // 4. Try accessing as Siswa 2 (the other student)
    $response = $this->actingAs($siswa2, 'siswa')
        ->get(route('jawaban.unduh', $hasil->id_hasil));

    $response->assertStatus(403);
});

test('student can download their own homework', function () {
    $guru = Guru::create([
        'nip' => '123456789012345678',
        'nama' => 'Guru 1',
        'username' => 'guru1',
        'password' => Hash::make('password'),
    ]);

    $siswa1 = Siswa::create([
        'nisn' => '1111111111',
        'nama' => 'Siswa 1',
        'kelas' => 'X-1',
        'username' => 'siswa1',
        'password' => Hash::make('password'),
    ]);

    $materi = Materi::create([
        'id_guru' => $guru->id_guru,
        'judul' => 'Materi 1',
        'isi_materi' => 'Konten materi 1',
        'tgl_upload' => now(),
    ]);

    $tugas = Tugas::create([
        'id_materi' => $materi->id_materi,
        'nama_tugas' => 'Tugas 1',
        'deskripsi' => 'Deskripsi tugas 1',
    ]);

    Storage::disk('local')->put('jawaban/siswa1_jawaban.txt', 'Jawaban Siswa 1');

    $hasil = Hasil::create([
        'id_tugas' => $tugas->id_tugas,
        'id_siswa' => $siswa1->id_siswa,
        'file_jawaban' => 'jawaban/siswa1_jawaban.txt',
        'tgl_kumpul' => now(),
    ]);

    $response = $this->actingAs($siswa1, 'siswa')
        ->get(route('jawaban.unduh', $hasil->id_hasil));

    $response->assertStatus(200);
});

test('guru who owns the assignment can download it', function () {
    $guru = Guru::create([
        'nip' => '123456789012345678',
        'nama' => 'Guru 1',
        'username' => 'guru1',
        'password' => Hash::make('password'),
    ]);

    $siswa1 = Siswa::create([
        'nisn' => '1111111111',
        'nama' => 'Siswa 1',
        'kelas' => 'X-1',
        'username' => 'siswa1',
        'password' => Hash::make('password'),
    ]);

    $materi = Materi::create([
        'id_guru' => $guru->id_guru,
        'judul' => 'Materi 1',
        'isi_materi' => 'Konten materi 1',
        'tgl_upload' => now(),
    ]);

    $tugas = Tugas::create([
        'id_materi' => $materi->id_materi,
        'nama_tugas' => 'Tugas 1',
        'deskripsi' => 'Deskripsi tugas 1',
    ]);

    Storage::disk('local')->put('jawaban/siswa1_jawaban.txt', 'Jawaban Siswa 1');

    $hasil = Hasil::create([
        'id_tugas' => $tugas->id_tugas,
        'id_siswa' => $siswa1->id_siswa,
        'file_jawaban' => 'jawaban/siswa1_jawaban.txt',
        'tgl_kumpul' => now(),
    ]);

    $response = $this->actingAs($guru, 'guru')
        ->get(route('jawaban.unduh', $hasil->id_hasil));

    $response->assertStatus(200);
});

test('guru who does not own the assignment cannot download it', function () {
    $guru1 = Guru::create([
        'nip' => '123456789012345678',
        'nama' => 'Guru 1',
        'username' => 'guru1',
        'password' => Hash::make('password'),
    ]);

    $guru2 = Guru::create([
        'nip' => '123456789012345679',
        'nama' => 'Guru 2',
        'username' => 'guru2',
        'password' => Hash::make('password'),
    ]);

    $siswa1 = Siswa::create([
        'nisn' => '1111111111',
        'nama' => 'Siswa 1',
        'kelas' => 'X-1',
        'username' => 'siswa1',
        'password' => Hash::make('password'),
    ]);

    $materi = Materi::create([
        'id_guru' => $guru1->id_guru,
        'judul' => 'Materi 1',
        'isi_materi' => 'Konten materi 1',
        'tgl_upload' => now(),
    ]);

    $tugas = Tugas::create([
        'id_materi' => $materi->id_materi,
        'nama_tugas' => 'Tugas 1',
        'deskripsi' => 'Deskripsi tugas 1',
    ]);

    Storage::disk('local')->put('jawaban/siswa1_jawaban.txt', 'Jawaban Siswa 1');

    $hasil = Hasil::create([
        'id_tugas' => $tugas->id_tugas,
        'id_siswa' => $siswa1->id_siswa,
        'file_jawaban' => 'jawaban/siswa1_jawaban.txt',
        'tgl_kumpul' => now(),
    ]);

    $response = $this->actingAs($guru2, 'guru')
        ->get(route('jawaban.unduh', $hasil->id_hasil));

    $response->assertStatus(403);
});

test('logged in siswa and guru can download materi file via materi.unduh', function () {
    Storage::fake('public');
    Storage::disk('public')->put('materi/test_materi.pdf', 'PDF CONTENT');

    $guru = Guru::create([
        'nip' => '123456789012345678',
        'nama' => 'Guru 1',
        'username' => 'guru_materi',
        'password' => Hash::make('password'),
    ]);

    $siswa = Siswa::create([
        'nisn' => '1234567890',
        'nama' => 'Siswa Materi',
        'kelas' => 'Kelas X',
        'username' => 'siswa_materi',
        'password' => Hash::make('password'),
    ]);

    $materi = Materi::create([
        'id_guru' => $guru->id_guru,
        'judul' => 'Materi PDF Test',
        'isi_materi' => 'Konten materi test',
        'file_materi' => 'materi/test_materi.pdf',
        'tgl_upload' => now(),
    ]);

    // Guest cannot download
    $resGuest = $this->get(route('materi.unduh', $materi->id_materi));
    $resGuest->assertStatus(401);

    // Siswa can download
    $resSiswa = $this->actingAs($siswa, 'siswa')->get(route('materi.unduh', $materi->id_materi));
    $resSiswa->assertStatus(200);

    // Guru can download
    $resGuru = $this->actingAs($guru, 'guru')->get(route('materi.unduh', $materi->id_materi));
    $resGuru->assertStatus(200);
});
