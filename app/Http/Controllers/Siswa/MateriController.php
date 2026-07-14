<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    /**
     * Tampilkan daftar semua materi untuk siswa.
     */
    public function index()
    {
        $materi = Materi::with('guru')->get();

        return view('siswa.materi.index', compact('materi'));
    }

    /**
     * Tampilkan detail materi.
     */
    public function show($id)
    {
        $materi = Materi::with('guru')->findOrFail($id);

        return view('siswa.materi.show', compact('materi'));
    }
}
