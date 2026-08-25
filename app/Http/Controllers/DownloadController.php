<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    /**
     * Mengunduh berkas jawaban secara aman dengan otorisasi.
     */
    public function unduhJawaban($id_hasil)
    {
        $hasil = Hasil::with('tugas.materi')->findOrFail($id_hasil);

        // 1. Verifikasi jika Guru login
        if (Auth::guard('guru')->check()) {
            $guru = Auth::guard('guru')->user();
            // Pastikan guru ini adalah pembuat materi untuk tugas tersebut
            if ($hasil->tugas->materi->id_guru !== $guru->id_guru) {
                abort(403, 'Anda tidak memiliki hak akses untuk mengunduh jawaban ini.');
            }
        }
        // 2. Verifikasi jika Siswa login
        elseif (Auth::guard('siswa')->check()) {
            $siswa = Auth::guard('siswa')->user();
            // Pastikan siswa hanya mengunduh jawaban miliknya sendiri
            if ($hasil->id_siswa !== $siswa->id_siswa) {
                abort(403, 'Anda tidak diperbolehkan mengunduh berkas jawaban siswa lain.');
            }
        }
        // 3. Jika tidak terautentikasi
        else {
            abort(401, 'Silakan login terlebih dahulu.');
        }

        // Pastikan berkas jawaban ada di database dan storage
        if (!$hasil->file_jawaban || !Storage::disk('local')->exists($hasil->file_jawaban)) {
            abort(404, 'Berkas jawaban tidak ditemukan.');
        }

        return Storage::disk('local')->download($hasil->file_jawaban);
    }
}
