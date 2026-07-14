<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
    protected $table = 'siswa';

    protected $primaryKey = 'id_siswa';

    protected $fillable = [
        'nisn',
        'nama',
        'kelas',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Siswa memiliki banyak Hasil.
     */
    public function hasil()
    {
        return $this->hasMany(Hasil::class, 'id_siswa', 'id_siswa');
    }
}
