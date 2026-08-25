<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Tugas;
use App\Models\Hasil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekapProgresController extends Controller
{
    /**
     * Tampilkan rekapitulasi progres belajar seluruh siswa berdasarkan tugas milik guru login.
     */
    public function index()
    {
        $guru = Auth::guard('guru')->user();

        // Ambil semua tugas milik guru login
        $tugasIds = Tugas::whereHas('materi', function ($q) use ($guru) {
            $q->where('id_guru', $guru->id_guru);
        })->pluck('id_tugas')->toArray();

        $totalTugas = count($tugasIds);

        // Ambil seluruh siswa
        $siswa = Siswa::all();

        foreach ($siswa as $item) {
            // Tugas dikumpulkan oleh siswa ini pada tugas milik guru login
            $dikumpul = Hasil::where('id_siswa', $item->id_siswa)
                ->whereIn('id_tugas', $tugasIds)
                ->whereNotNull('file_jawaban')
                ->count();

            // Tugas sudah dinilai
            $dinilai = Hasil::where('id_siswa', $item->id_siswa)
                ->whereIn('id_tugas', $tugasIds)
                ->whereNotNull('nilai')
                ->count();

            // Rata-rata nilai tugas milik guru login
            $avgNilai = Hasil::where('id_siswa', $item->id_siswa)
                ->whereIn('id_tugas', $tugasIds)
                ->whereNotNull('nilai')
                ->avg('nilai');

            $item->total_tugas = $totalTugas;
            $item->tugas_dikumpul = $dikumpul;
            $item->tugas_belum_dikumpul = max(0, $totalTugas - $dikumpul);
            $item->tugas_dinilai = $dinilai;
            $item->rata_rata = $avgNilai !== null ? round($avgNilai, 1) : '-';
            
            // Persentase progres pengumpulan
            $item->persentase = $totalTugas > 0 ? round(($dikumpul / $totalTugas) * 100) : 0;
        }

        return view('guru.rekap.index', compact('siswa'));
    }

    /**
     * Tampilkan detail progres satu siswa.
     */
    public function show($id_siswa)
    {
        $guru = Auth::guard('guru')->user();
        $siswa = Siswa::findOrFail($id_siswa);

        // Ambil semua tugas milik guru login
        $tugas = Tugas::whereHas('materi', function ($q) use ($guru) {
            $q->where('id_guru', $guru->id_guru);
        })->with('materi')->get();

        $tugasIds = $tugas->pluck('id_tugas')->toArray();

        // Ambil hasil pengumpulan siswa ini untuk tugas milik guru login
        $hasil = Hasil::where('id_siswa', $siswa->id_siswa)
            ->whereIn('id_tugas', $tugasIds)
            ->get()
            ->keyBy('id_tugas');

        // Tambah status kustom pada masing-masing tugas
        foreach ($tugas as $item) {
            $item_hasil = $hasil->get($item->id_tugas);
            
            if (!$item_hasil || !$item_hasil->file_jawaban) {
                $item->status = 'Belum Dikumpulkan';
                $item->file_jawaban = null;
                $item->tgl_kumpul = null;
                $item->nilai = null;
            } else {
                $item->id_hasil = $item_hasil->id_hasil;
                $item->file_jawaban = $item_hasil->file_jawaban;
                $item->tgl_kumpul = $item_hasil->tgl_kumpul;
                
                if ($item_hasil->nilai !== null) {
                    $item->status = 'Sudah Dinilai';
                    $item->nilai = $item_hasil->nilai;
                } else {
                    $item->status = 'Sudah Dikumpulkan';
                    $item->nilai = null;
                }
            }
        }

        // Rata-rata nilai siswa pada tugas milik guru login
        $avgNilai = Hasil::where('id_siswa', $siswa->id_siswa)
            ->whereIn('id_tugas', $tugasIds)
            ->whereNotNull('nilai')
            ->avg('nilai');

        $rata_rata = $avgNilai !== null ? round($avgNilai, 1) : '-';

        return view('guru.rekap.show', compact('siswa', 'tugas', 'rata_rata'));
    }
}
