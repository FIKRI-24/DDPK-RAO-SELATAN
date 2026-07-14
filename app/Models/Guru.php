<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Guru extends Authenticatable
{
    protected $table = 'guru';

    protected $primaryKey = 'id_guru';

    protected $fillable = [
        'nip',
        'nama',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Guru memiliki banyak Materi.
     */
    public function materi()
    {
        return $this->hasMany(Materi::class, 'id_guru', 'id_guru');
    }
}
