<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use App\Models\Hasil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class TugasController extends Controller
{
    /**
     * Tampilkan daftar tugas tersedia untuk siswa beserta status pengumpulannya.
     */
    public function index()
    {
        $siswa = Auth::guard('siswa')->user();
        $tugas = Tugas::with('materi.guru')->get();

        // Ambil ID tugas yang sudah dikumpulkan oleh siswa ini
        $sudahDikumpulIds = Hasil::where('id_siswa', $siswa->id_siswa)
            ->whereNotNull('file_jawaban')
            ->pluck('id_tugas')
            ->toArray();

        return view('siswa.tugas.index', compact('tugas', 'sudahDikumpulIds'));
    }

    /**
     * Tampilkan detail tugas dan status pengumpulan siswa.
     */
    public function show($id)
    {
        $siswa = Auth::guard('siswa')->user();
        $tugas = Tugas::with('materi.guru')->findOrFail($id);

        // Cari hasil pengumpulan lama siswa untuk tugas ini
        $hasil = Hasil::where('id_tugas', $tugas->id_tugas)
            ->where('id_siswa', $siswa->id_siswa)
            ->first();

        return view('siswa.tugas.show', compact('tugas', 'hasil'));
    }

    /**
     * Upload atau ganti file jawaban siswa.
     */
    public function submit(Request $request, $id)
    {
        $request->validate([
            'file_jawaban' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,jpg,jpeg,png,zip,rar|max:5120',
        ]);

        $siswa = Auth::guard('siswa')->user();
        $tugas = Tugas::findOrFail($id);

        DB::transaction(function () use ($request, $tugas, $siswa) {
            // Cari data hasil lama atau buat baru
            $hasil = Hasil::firstOrNew([
                'id_tugas' => $tugas->id_tugas,
                'id_siswa' => $siswa->id_siswa,
            ]);

            // Jika ada file lama di storage, hapus
            if ($hasil->file_jawaban) {
                Storage::disk('public')->delete($hasil->file_jawaban);
            }

            // Simpan file baru
            $filePath = $request->file('file_jawaban')->store('jawaban', 'public');

            $hasil->file_jawaban = $filePath;
            $hasil->tgl_kumpul = now();
            $hasil->nilai = null; // Reset/set null ketika upload ulang atau baru
            $hasil->save();
        });

        return redirect()->route('siswa.tugas.show', $tugas->id_tugas)->with('success', 'Jawaban tugas berhasil dikumpulkan.');
    }
}
