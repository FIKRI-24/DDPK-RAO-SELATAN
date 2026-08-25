<?php

use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;

test('guru can view petunjuk penggunaan guru', function () {
    $guru = Guru::create([
        'nip' => '198501012010011001',
        'nama' => 'Alfi Sahri',
        'username' => 'guru_test',
        'password' => Hash::make('password'),
    ]);

    $response = $this->actingAs($guru, 'guru')->get(route('guru.petunjuk.index'));
    $response->assertStatus(200);
    $response->assertSee('Petunjuk Penggunaan Media Guru');
});

test('siswa can view petunjuk penggunaan siswa', function () {
    $siswa = Siswa::create([
        'nisn' => '0012345601',
        'nama' => 'Ahmad Siswa',
        'kelas' => 'X-1',
        'username' => 'siswa_test',
        'password' => Hash::make('password'),
    ]);

    $response = $this->actingAs($siswa, 'siswa')->get(route('siswa.petunjuk.index'));
    $response->assertStatus(200);
    $response->assertSee('Petunjuk Penggunaan Media Siswa');
});

test('guest cannot access petunjuk pages', function () {
    $this->get(route('guru.petunjuk.index'))->assertRedirect(route('login'));
    $this->get(route('siswa.petunjuk.index'))->assertRedirect(route('login'));
});
