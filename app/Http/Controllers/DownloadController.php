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

    /**
     * Mengunduh berkas materi secara aman dan terjamin langsung melalui PHP response.
     */
    public function unduhMateri($id_materi)
    {
        // Pastikan pengguna sudah login baik sebagai Guru maupun Siswa
        if (!Auth::guard('guru')->check() && !Auth::guard('siswa')->check()) {
            abort(401, 'Silakan login terlebih dahulu untuk mengakses berkas materi.');
        }

        $materi = \App\Models\Materi::findOrFail($id_materi);

        if (!$materi->file_materi) {
            abort(404, 'Materi ini tidak memiliki lampiran berkas.');
        }

        // 1. Cek pada disk public
        if (Storage::disk('public')->exists($materi->file_materi)) {
            $path = Storage::disk('public')->path($materi->file_materi);
            return response()->file($path);
        }

        // 2. Fallback cek pada disk local / private
        if (Storage::disk('local')->exists($materi->file_materi)) {
            $path = Storage::disk('local')->path($materi->file_materi);
            return response()->file($path);
        }

        // 3. Fallback cek di storage_path langsung
        $directPath = storage_path('app/public/' . $materi->file_materi);
        if (file_exists($directPath)) {
            return response()->file($directPath);
        }

        abort(404, 'Berkas materi fisik tidak ditemukan di server.');
    }
}
