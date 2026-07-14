<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    /**
     * Tampilkan daftar siswa.
     */
    public function index()
    {
        $siswa = Siswa::latest()->get();
        return view('guru.siswa.index', compact('siswa'));
    }

    /**
     * Tampilkan form tambah siswa.
     */
    public function create()
    {
        return view('guru.siswa.create');
    }

    /**
     * Simpan data siswa baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string|max:30|unique:siswa,nisn',
            'nama' => 'required|string|max:100',
            'kelas' => 'required|string|max:50',
            'username' => 'required|string|max:50|unique:siswa,username',
            'password' => 'required|string|min:6',
        ], [
            'nisn.required' => 'NISN wajib diisi.',
            'nisn.unique' => 'NISN sudah terdaftar.',
            'nama.required' => 'Nama siswa wajib diisi.',
            'kelas.required' => 'Kelas wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal terdiri dari 6 karakter.',
        ]);

        Siswa::create([
            'nisn' => $request->nisn,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('guru.siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    /**
     * Detail siswa (redirect ke edit).
     */
    public function show($id)
    {
        return redirect()->route('guru.siswa.edit', $id);
    }

    /**
     * Tampilkan form edit siswa.
     */
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('guru.siswa.edit', compact('siswa'));
    }

    /**
     * Perbarui data siswa.
     */
    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'nisn' => 'required|string|max:30|unique:siswa,nisn,' . $id . ',id_siswa',
            'nama' => 'required|string|max:100',
            'kelas' => 'required|string|max:50',
            'username' => 'required|string|max:50|unique:siswa,username,' . $id . ',id_siswa',
            'password' => 'nullable|string|min:6',
        ], [
            'nisn.required' => 'NISN wajib diisi.',
            'nisn.unique' => 'NISN sudah terdaftar.',
            'nama.required' => 'Nama siswa wajib diisi.',
            'kelas.required' => 'Kelas wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'password.min' => 'Password minimal terdiri dari 6 karakter.',
        ]);

        $siswa->nisn = $request->nisn;
        $siswa->nama = $request->nama;
        $siswa->kelas = $request->kelas;
        $siswa->username = $request->username;

        if ($request->filled('password')) {
            $siswa->password = Hash::make($request->password);
        }

        $siswa->save();

        return redirect()->route('guru.siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Hapus data siswa.
     */
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);

        DB::transaction(function () use ($siswa) {
            // Hapus file jawaban fisik milik siswa ini sebelum hapus data
            foreach ($siswa->hasil as $hasil) {
                if ($hasil->file_jawaban) {
                    Storage::disk('public')->delete($hasil->file_jawaban);
                }
            }

            $siswa->hasil()->delete();
            $siswa->delete();
        });

        return redirect()->route('guru.siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
