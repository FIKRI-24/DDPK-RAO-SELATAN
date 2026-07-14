<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        Guru::create([
            'nip' => '198501012010011001',
            'nama' => 'Alfi Sahri',
            'username' => 'guru',
            'password' => Hash::make('alfi123'),
        ]);
    }
}
