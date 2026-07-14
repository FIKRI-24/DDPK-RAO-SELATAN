<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use App\Models\Materi;
use App\Models\Siswa;
use App\Models\Hasil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    /**
     * Tampilkan daftar tugas dari materi milik guru yang login.
     */
    public function index()
    {
        $guru = Auth::guard('guru')->user();
        
        $tugas = Tugas::whereHas('materi', function ($query) use ($guru) {
            $query->where('id_guru', $guru->id_guru);
        })->with('materi')->get();

        return view('guru.tugas.index', compact('tugas'));
    }

    /**
     * Form tambah tugas.
     */
    public function create()
    {
        $guru = Auth::guard('guru')->user();
        $materi = Materi::where('id_guru', $guru->id_guru)->get();

        return view('guru.tugas.create', compact('materi'));
    }

    /**
     * Simpan tugas baru.
     */
    public function store(Request $request)
    {
        $guru = Auth::guard('guru')->user();

        $request->validate([
            'id_materi' => 'required|exists:materi,id_materi',
            'nama_tugas' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        // Pastikan materi yang dipilih adalah milik guru login
        $materi = Materi::findOrFail($request->id_materi);
        if ($materi->id_guru !== $guru->id_guru) {
            abort(403, 'Anda tidak memiliki hak akses untuk materi ini.');
        }

        Tugas::create([
            'id_materi' => $request->id_materi,
            'nama_tugas' => $request->nama_tugas,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil ditambahkan.');
    }

    /**
     * Detail tugas dan daftar siswa yang sudah/belum mengumpulkan.
     */
    public function show($id)
    {
        $tugas = Tugas::with('materi')->findOrFail($id);
        $guru = Auth::guard('guru')->user();

        // Cek owner
        if ($tugas->materi->id_guru !== $guru->id_guru) {
            abort(403, 'Anda tidak memiliki hak akses untuk tugas ini.');
        }

        // Ambil hasil pengumpulan
        $hasil = Hasil::where('id_tugas', $tugas->id_tugas)
            ->whereNotNull('file_jawaban')
            ->with('siswa')
            ->get();

        $siswaSudahId = $hasil->pluck('id_siswa')->toArray();

        // Siswa yang belum mengumpulkan
        $siswaBelum = Siswa::whereNotIn('id_siswa', $siswaSudahId)->get();

        return view('guru.tugas.show', compact('tugas', 'hasil', 'siswaBelum'));
    }

    /**
     * Form edit tugas.
     */
    public function edit($id)
    {
        $tugas = Tugas::with('materi')->findOrFail($id);
        $guru = Auth::guard('guru')->user();

        // Cek owner
        if ($tugas->materi->id_guru !== $guru->id_guru) {
            abort(403, 'Anda tidak memiliki hak akses untuk mengedit tugas ini.');
        }

        return view('guru.tugas.edit', compact('tugas'));
    }

    /**
     * Update tugas.
     */
    public function update(Request $request, $id)
    {
        $tugas = Tugas::with('materi')->findOrFail($id);
        $guru = Auth::guard('guru')->user();

        // Cek owner
        if ($tugas->materi->id_guru !== $guru->id_guru) {
            abort(403, 'Anda tidak memiliki hak akses untuk memperbarui tugas ini.');
        }

        $request->validate([
            'nama_tugas' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $tugas->update([
            'nama_tugas' => $request->nama_tugas,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil diperbarui.');
    }

    /**
     * Hapus tugas.
     */
    public function destroy($id)
    {
        $tugas = Tugas::with('materi')->findOrFail($id);
        $guru = Auth::guard('guru')->user();

        // Cek owner
        if ($tugas->materi->id_guru !== $guru->id_guru) {
            abort(403, 'Anda tidak memiliki hak akses untuk menghapus tugas ini.');
        }

        // Jika tugas sudah memiliki data pengumpulan, tolak penghapusan
        $hasCollection = Hasil::where('id_tugas', $tugas->id_tugas)
            ->whereNotNull('file_jawaban')
            ->exists();

        if ($hasCollection) {
            return redirect()->route('guru.tugas.index')->with('error', 'Tugas tidak dapat dihapus karena sudah memiliki pengumpulan siswa.');
        }

        $tugas->delete();

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil dihapus.');
    }
}
