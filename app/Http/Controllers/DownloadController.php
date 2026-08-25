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
            return back()->with('error', 'Materi ini tidak menyertakan lampiran berkas.');
        }

        $possiblePaths = [
            Storage::disk('public')->path($materi->file_materi),
            Storage::disk('local')->path($materi->file_materi),
            storage_path('app/public/' . $materi->file_materi),
            storage_path('app/' . $materi->file_materi),
            public_path('storage/' . $materi->file_materi),
            base_path('storage/app/public/' . $materi->file_materi),
            resource_path('initial_storage/public/' . $materi->file_materi),
        ];

        foreach ($possiblePaths as $path) {
            if ($path && file_exists($path)) {
                $filename = basename($materi->file_materi);
                return response()->file($path, [
                    'Content-Disposition' => 'inline; filename="' . $filename . '"',
                ]);
            }
        }

        return back()->with('error', 'Berkas lampiran "' . basename($materi->file_materi) . '" untuk materi "' . $materi->judul . '" tidak ditemukan di server.');
    }
}
