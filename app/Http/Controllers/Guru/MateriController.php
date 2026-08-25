<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class MateriController extends Controller
{
    /**
     * Tampilkan daftar materi milik guru yang login.
     */
    public function index()
    {
        $guru = Auth::guard('guru')->user();
        $materi = Materi::where('id_guru', $guru->id_guru)->get();

        return view('guru.materi.index', compact('materi'));
    }

    /**
     * Form tambah materi.
     */
    public function create()
    {
        return view('guru.materi.create');
    }

    /**
     * Simpan materi baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi_materi' => 'required|string',
            'file_materi' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,jpg,jpeg,png|max:5120',
        ]);

        $guru = Auth::guard('guru')->user();
        $filePath = null;

        if ($request->hasFile('file_materi')) {
            $filePath = $request->file('file_materi')->store('materi', 'public');
        }

        Materi::create([
            'id_guru' => $guru->id_guru,
            'judul' => $request->judul,
            'isi_materi' => $request->isi_materi,
            'file_materi' => $filePath,
            'tgl_upload' => now(),
        ]);

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil ditambahkan.');
    }

    /**
     * Detail materi.
     */
    public function show($id)
    {
        $materi = Materi::findOrFail($id);
        $guru = Auth::guard('guru')->user();

        // Keamanan: Pastikan hanya pembuat yang bisa melihat detail via panel guru
        if ($materi->id_guru !== $guru->id_guru) {
            abort(403, 'Anda tidak memiliki hak akses untuk materi ini.');
        }

        return view('guru.materi.show', compact('materi'));
    }

    /**
     * Form edit materi.
     */
    public function edit($id)
    {
        $materi = Materi::findOrFail($id);
        $guru = Auth::guard('guru')->user();

        // Keamanan: Cek kepemilikan
        if ($materi->id_guru !== $guru->id_guru) {
            abort(403, 'Anda tidak memiliki hak akses untuk mengubah materi ini.');
        }

        return view('guru.materi.edit', compact('materi'));
    }

    /**
     * Update materi.
     */
    public function update(Request $request, $id)
    {
        $materi = Materi::findOrFail($id);
        $guru = Auth::guard('guru')->user();

        // Keamanan: Cek kepemilikan
        if ($materi->id_guru !== $guru->id_guru) {
            abort(403, 'Anda tidak memiliki hak akses untuk mengubah materi ini.');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi_materi' => 'required|string',
            'file_materi' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,jpg,jpeg,png|max:5120',
        ]);

        $materi->judul = $request->judul;
        $materi->isi_materi = $request->isi_materi;

        if ($request->hasFile('file_materi')) {
            // Hapus file lama jika ada
            if ($materi->file_materi) {
                Storage::disk('public')->delete($materi->file_materi);
            }
            $filePath = $request->file('file_materi')->store('materi', 'public');
            $materi->file_materi = $filePath;
        }

        $materi->save();

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

    /**
     * Hapus materi.
     */
    public function destroy($id)
    {
        $materi = Materi::with('tugas.hasil')->findOrFail($id);
        $guru = Auth::guard('guru')->user();

        if ($materi->id_guru !== $guru->id_guru) {
            abort(403, 'Anda tidak memiliki hak akses untuk menghapus materi ini.');
        }

        DB::transaction(function () use ($materi) {
            // Hapus semua file jawaban siswa dari seluruh tugas di materi ini
            foreach ($materi->tugas as $tugas) {
                foreach ($tugas->hasil as $hasil) {
                    if ($hasil->file_jawaban) {
                        Storage::disk('local')->delete($hasil->file_jawaban);
                    }
                }
            }

            // Hapus file materi fisik
            if ($materi->file_materi) {
                Storage::disk('public')->delete($materi->file_materi);
            }

            $materi->delete();
        });

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil dihapus.');
    }
}
