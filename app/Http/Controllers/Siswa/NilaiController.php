<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use App\Models\Hasil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    /**
     * Tampilkan halaman ringkasan nilai dan progres belajar siswa login.
     */
    public function index()
    {
        $siswa = Auth::guard('siswa')->user();

        // Hitung total tugas global (seluruh guru)
        $totalTugas = Tugas::count();

        // Hitung tugas yang dikumpulkan siswa ini
        $dikumpul = Hasil::where('id_siswa', $siswa->id_siswa)
            ->whereNotNull('file_jawaban')
            ->count();

        // Hitung tugas sudah dinilai
        $dinilai = Hasil::where('id_siswa', $siswa->id_siswa)
            ->whereNotNull('nilai')
            ->count();

        // Hitung rata-rata nilai siswa login
        $avgNilai = Hasil::where('id_siswa', $siswa->id_siswa)
            ->whereNotNull('nilai')
            ->avg('nilai');

        $stats = [
            'total_tugas' => $totalTugas,
            'dikumpul' => $dikumpul,
            'belum_dikumpul' => max(0, $totalTugas - $dikumpul),
            'dinilai' => $dinilai,
            'rata_rata' => $avgNilai !== null ? round($avgNilai, 1) : '-',
            'persentase' => $totalTugas > 0 ? round(($dikumpul / $totalTugas) * 100) : 0,
        ];

        // Ambil semua tugas untuk ditampilkan dalam daftar beserta nilainya
        $tugas = Tugas::with('materi.guru')->get();
        $hasil = Hasil::where('id_siswa', $siswa->id_siswa)->get()->keyBy('id_tugas');

        foreach ($tugas as $item) {
            $item_hasil = $hasil->get($item->id_tugas);
            if (!$item_hasil || !$item_hasil->file_jawaban) {
                $item->status = 'Belum Dikumpulkan';
                $item->nilai = null;
            } else {
                if ($item_hasil->nilai !== null) {
                    $item->status = 'Sudah Dinilai';
                    $item->nilai = $item_hasil->nilai;
                } else {
                    $item->status = 'Sudah Dikumpulkan';
                    $item->nilai = null;
                }
            }
        }

        return view('siswa.nilai.index', compact('stats', 'tugas'));
    }

    /**
     * Tampilkan detail nilai untuk satu tugas secara privat.
     */
    public function show($id_tugas)
    {
        $siswa = Auth::guard('siswa')->user();
        $tugas = Tugas::with('materi.guru')->findOrFail($id_tugas);

        // Ambil hasil pengumpulan siswa ini untuk tugas tersebut
        $hasil = Hasil::where('id_tugas', $tugas->id_tugas)
            ->where('id_siswa', $siswa->id_siswa)
            ->first();

        return view('siswa.nilai.show', compact('tugas', 'hasil'));
    }
}
