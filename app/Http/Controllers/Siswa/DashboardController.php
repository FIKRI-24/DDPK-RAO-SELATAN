<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Materi;
use App\Models\Tugas;
use App\Models\Hasil;

class DashboardController extends Controller
{
    public function index()
    {
        $siswa = Auth::guard('siswa')->user();

        $tugasSudahDikumpulkan = Hasil::where('id_siswa', $siswa->id_siswa)
            ->whereNotNull('file_jawaban')
            ->distinct('id_tugas')
            ->count('id_tugas');

        $totalTugas = Tugas::count();

        $dinilaiCount = Hasil::where('id_siswa', $siswa->id_siswa)
            ->whereNotNull('nilai')
            ->count();

        $avgNilai = Hasil::where('id_siswa', $siswa->id_siswa)
            ->whereNotNull('nilai')
            ->avg('nilai');

        $persentaseKumpul = $totalTugas > 0 ? round(($tugasSudahDikumpulkan / $totalTugas) * 100) : 0;

        $stats = [
            'materi_count' => Materi::count(),
            'tugas_count' => $totalTugas,
            'sudah_dikumpul' => $tugasSudahDikumpulkan,
            'belum_dikumpul' => max(0, $totalTugas - $tugasSudahDikumpulkan),
            'dinilai' => $dinilaiCount,
            'rata_rata' => $avgNilai !== null ? round($avgNilai, 1) : '-',
            'persentase_kumpul' => $persentaseKumpul,
        ];

        return view('siswa.dashboard', compact('siswa', 'stats'));
    }
}
