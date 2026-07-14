<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use App\Models\Hasil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    /**
     * Tampilkan daftar tugas milik guru login.
     */
    public function index()
    {
        $guru = Auth::guard('guru')->user();

        // Ambil semua tugas dari materi milik guru login
        $tugas = Tugas::whereHas('materi', function ($q) use ($guru) {
            $q->where('id_guru', $guru->id_guru);
        })->with('materi')->get();

        // Hitung statistik untuk masing-masing tugas
        foreach ($tugas as $item) {
            $item->dikumpul_count = Hasil::where('id_tugas', $item->id_tugas)
                ->whereNotNull('file_jawaban')
                ->count();

            $item->dinilai_count = Hasil::where('id_tugas', $item->id_tugas)
                ->whereNotNull('nilai')
                ->count();

            $item->belum_dinilai_count = Hasil::where('id_tugas', $item->id_tugas)
                ->whereNotNull('file_jawaban')
                ->whereNull('nilai')
                ->count();
        }

        return view('guru.penilaian.index', compact('tugas'));
    }

    /**
     * Tampilkan detail tugas dan daftar pengumpulan yang ada berkas jawabannya.
     */
    public function show($id_tugas)
    {
        $guru = Auth::guard('guru')->user();
        $tugas = Tugas::with('materi')->findOrFail($id_tugas);

        // Otorisasi: Pastikan materi tugas ini milik guru login
        if ($tugas->materi->id_guru !== $guru->id_guru) {
            abort(403, 'Anda tidak memiliki hak akses untuk penilaian tugas ini.');
        }

        // Ambil hanya pengumpulan yang ada file jawabannya
        $hasil = Hasil::where('id_tugas', $tugas->id_tugas)
            ->whereNotNull('file_jawaban')
            ->with('siswa')
            ->get();

        return view('guru.penilaian.show', compact('tugas', 'hasil'));
    }

    /**
     * Tampilkan form input/edit nilai.
     */
    public function edit($id_hasil)
    {
        $guru = Auth::guard('guru')->user();
        $hasil = Hasil::with('tugas.materi', 'siswa')->findOrFail($id_hasil);

        // Otorisasi: Pastikan materi tugas dari hasil ini milik guru login
        if ($hasil->tugas->materi->id_guru !== $guru->id_guru) {
            abort(403, 'Anda tidak memiliki hak akses untuk menilai pengumpulan ini.');
        }

        // Pastikan siswa sudah mengumpulkan file
        if (!$hasil->file_jawaban) {
            return redirect()->route('guru.penilaian.show', $hasil->id_tugas)
                ->with('error', 'Siswa belum mengumpulkan berkas jawaban untuk tugas ini.');
        }

        return view('guru.penilaian.edit', compact('hasil'));
    }

    /**
     * Update/Simpan nilai tugas.
     */
    public function update(Request $request, $id_hasil)
    {
        $guru = Auth::guard('guru')->user();
        $hasil = Hasil::with('tugas.materi')->findOrFail($id_hasil);

        // Otorisasi
        if ($hasil->tugas->materi->id_guru !== $guru->id_guru) {
            abort(403, 'Anda tidak memiliki hak akses untuk menilai pengumpulan ini.');
        }

        $request->validate([
            'nilai' => 'required|integer|min:0|max:100',
        ]);

        $hasil->nilai = $request->input('nilai');
        $hasil->save();

        return redirect()->route('guru.penilaian.show', $hasil->id_tugas)
            ->with('success', 'Nilai siswa ' . $hasil->siswa->nama . ' berhasil diperbarui.');
    }
}
