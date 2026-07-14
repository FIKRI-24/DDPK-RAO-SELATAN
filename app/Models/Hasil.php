<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    protected $table = 'hasil';

    protected $primaryKey = 'id_hasil';

    protected $fillable = [
        'id_tugas',
        'id_siswa',
        'file_jawaban',
        'nilai',
        'tgl_kumpul',
    ];

    /**
     * Hasil dimiliki oleh Tugas.
     */
    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'id_tugas', 'id_tugas');
    }

    /**
     * Hasil dimiliki oleh Siswa.
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }
}
