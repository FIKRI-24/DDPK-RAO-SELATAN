<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Materi;
use App\Models\Tugas;
use App\Models\Siswa;
use App\Models\Hasil;

class DashboardController extends Controller
{
    public function index()
    {
        $guru = Auth::guard('guru')->user();

        $materiCount = Materi::where('id_guru', $guru->id_guru)->count();
        $tugasCount = Tugas::whereHas('materi', function ($q) use ($guru) {
            $q->where('id_guru', $guru->id_guru);
        })->count();
        $siswaCount = Siswa::count();
        $hasilCount = Hasil::whereHas('tugas.materi', function ($q) use ($guru) {
            $q->where('id_guru', $guru->id_guru);
        })->whereNotNull('file_jawaban')->count();

        $belumDinilaiCount = Hasil::whereHas('tugas.materi', function ($q) use ($guru) {
            $q->where('id_guru', $guru->id_guru);
        })->whereNotNull('file_jawaban')->whereNull('nilai')->count();

        $dinilaiCount = Hasil::whereHas('tugas.materi', function ($q) use ($guru) {
            $q->where('id_guru', $guru->id_guru);
        })->whereNotNull('file_jawaban')->whereNotNull('nilai')->count();

        $evaluasiPersen = $hasilCount > 0 ? round(($dinilaiCount / $hasilCount) * 100) : 0;

        $stats = [
            'materi_count' => $materiCount,
            'tugas_count' => $tugasCount,
            'siswa_count' => $siswaCount,
            'hasil_count' => $hasilCount,
            'belum_dinilai_count' => $belumDinilaiCount,
            'dinilai_count' => $dinilaiCount,
            'evaluasi_persen' => $evaluasiPersen,
        ];

        return view('guru.dashboard', compact('guru', 'stats'));
    }
}
