<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Guru\MateriController as GuruMateriController;
use App\Http\Controllers\Siswa\MateriController as SiswaMateriController;
use App\Http\Controllers\Guru\TugasController as GuruTugasController;
use App\Http\Controllers\Siswa\TugasController as SiswaTugasController;
use App\Http\Controllers\Guru\PenilaianController;
use App\Http\Controllers\Guru\RekapProgresController;
use App\Http\Controllers\Guru\PetunjukController as GuruPetunjukController;
use App\Http\Controllers\Siswa\NilaiController;
use App\Http\Controllers\Siswa\PetunjukController as SiswaPetunjukController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama redirect ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Guru routes
Route::prefix('guru')->middleware('auth.guru')->group(function () {
    Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('guru.dashboard');
    
    // CRUD Siswa Guru
    Route::resource('siswa', \App\Http\Controllers\Guru\SiswaController::class)->names([
        'index' => 'guru.siswa.index',
        'create' => 'guru.siswa.create',
        'store' => 'guru.siswa.store',
        'show' => 'guru.siswa.show',
        'edit' => 'guru.siswa.edit',
        'update' => 'guru.siswa.update',
        'destroy' => 'guru.siswa.destroy',
    ]);

    // CRUD Materi Guru
    Route::resource('materi', GuruMateriController::class)->names([
        'index' => 'guru.materi.index',
        'create' => 'guru.materi.create',
        'store' => 'guru.materi.store',
        'show' => 'guru.materi.show',
        'edit' => 'guru.materi.edit',
        'update' => 'guru.materi.update',
        'destroy' => 'guru.materi.destroy',
    ]);

    // CRUD Tugas Guru
    Route::resource('tugas', GuruTugasController::class)->names([
        'index' => 'guru.tugas.index',
        'create' => 'guru.tugas.create',
        'store' => 'guru.tugas.store',
        'show' => 'guru.tugas.show',
        'edit' => 'guru.tugas.edit',
        'update' => 'guru.tugas.update',
        'destroy' => 'guru.tugas.destroy',
    ]);

    // Penilaian Guru
    Route::get('/penilaian', [PenilaianController::class, 'index'])->name('guru.penilaian.index');
    Route::get('/penilaian/tugas/{id_tugas}', [PenilaianController::class, 'show'])->name('guru.penilaian.show');
    Route::get('/penilaian/hasil/{id_hasil}/edit', [PenilaianController::class, 'edit'])->name('guru.penilaian.edit');
    Route::put('/penilaian/hasil/{id_hasil}', [PenilaianController::class, 'update'])->name('guru.penilaian.update');

    // Rekap Progres Guru
    Route::get('/rekap-progres', [RekapProgresController::class, 'index'])->name('guru.rekap.index');
    Route::get('/rekap-progres/siswa/{id_siswa}', [RekapProgresController::class, 'show'])->name('guru.rekap.show');

    // Petunjuk Penggunaan Guru
    Route::get('/petunjuk', [GuruPetunjukController::class, 'index'])->name('guru.petunjuk.index');
});

// Siswa routes
Route::prefix('siswa')->middleware('auth.siswa')->group(function () {
    Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('siswa.dashboard');
    
    // Read-only Materi Siswa
    Route::get('/materi', [SiswaMateriController::class, 'index'])->name('siswa.materi.index');
    Route::get('/materi/{id}', [SiswaMateriController::class, 'show'])->name('siswa.materi.show');

    // Tugas Siswa
    Route::get('/tugas', [SiswaTugasController::class, 'index'])->name('siswa.tugas.index');
    Route::get('/tugas/{id}', [SiswaTugasController::class, 'show'])->name('siswa.tugas.show');
    Route::post('/tugas/{id}/submit', [SiswaTugasController::class, 'submit'])->name('siswa.tugas.submit');

    // Nilai & Progres Siswa
    Route::get('/nilai-progres', [NilaiController::class, 'index'])->name('siswa.nilai.index');
    Route::get('/nilai-progres/tugas/{id_tugas}', [NilaiController::class, 'show'])->name('siswa.nilai.show');

    // Petunjuk Penggunaan Siswa
    Route::get('/petunjuk', [SiswaPetunjukController::class, 'index'])->name('siswa.petunjuk.index');
});

// Route unduhan jawaban aman (diakses oleh Guru atau Siswa terverifikasi)
Route::get('/jawaban/unduh/{id_hasil}', [\App\Http\Controllers\DownloadController::class, 'unduhJawaban'])->name('jawaban.unduh');

