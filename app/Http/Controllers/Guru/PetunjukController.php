<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PetunjukController extends Controller
{
    /**
     * Menampilkan halaman petunjuk penggunaan media pembelajaran untuk Guru.
     */
    public function index()
    {
        return view('guru.petunjuk.index');
    }
}
