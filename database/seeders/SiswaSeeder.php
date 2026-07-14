<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $siswaData = [
            [
                'nisn' => '0012345601',
                'nama' => 'Ahmad Siswa',
                'kelas' => 'X-1',
                'username' => 'siswa1',
                'password' => Hash::make('password123'),
            ],
            [
                'nisn' => '0012345602',
                'nama' => 'Budi Siswa',
                'kelas' => 'X-1',
                'username' => 'siswa2',
                'password' => Hash::make('password123'),
            ],
            [
                'nisn' => '0012345603',
                'nama' => 'Citra Siswa',
                'kelas' => 'X-2',
                'username' => 'siswa3',
                'password' => Hash::make('password123'),
            ],
        ];

        foreach ($siswaData as $siswa) {
            Siswa::create($siswa);
        }
    }
}
