<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PetunjukController extends Controller
{
    /**
     * Menampilkan halaman petunjuk penggunaan media pembelajaran untuk Siswa.
     */
    public function index()
    {
        return view('siswa.petunjuk.index');
    }
}
