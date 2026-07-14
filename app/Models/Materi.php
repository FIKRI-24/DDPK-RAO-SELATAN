<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materi';

    protected $primaryKey = 'id_materi';

    protected $fillable = [
        'id_guru',
        'judul',
        'isi_materi',
        'file_materi',
        'tgl_upload',
    ];

    /**
     * Materi dimiliki oleh Guru.
     */
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }

    /**
     * Materi memiliki banyak Tugas.
     */
    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'id_materi', 'id_materi');
    }
}
