<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $table = 'tugas';

    protected $primaryKey = 'id_tugas';

    protected $fillable = [
        'id_materi',
        'nama_tugas',
        'deskripsi',
    ];

    /**
     * Tugas dimiliki oleh Materi.
     */
    public function materi()
    {
        return $this->belongsTo(Materi::class, 'id_materi', 'id_materi');
    }

    /**
     * Tugas memiliki banyak Hasil.
     */
    public function hasil()
    {
        return $this->hasMany(Hasil::class, 'id_tugas', 'id_tugas');
    }
}
