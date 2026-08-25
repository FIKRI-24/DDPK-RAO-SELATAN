<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Pastikan folder direktori storage dasar selalu tersedia
        $publicMateriPath = storage_path('app/public/materi');
        if (!file_exists($publicMateriPath)) {
            File::makeDirectory($publicMateriPath, 0755, true, true);
        }

        // Jika modul materi awal belum ada di storage (misal volume baru di-mount), salin dari initial_storage
        $samplePdf = 'materi/ZdLPMXj12JqkxnFDUbrBsiDvIeg1G0IWRYr6GABI.pdf';
        if (!file_exists(storage_path('app/public/' . $samplePdf)) && file_exists(resource_path('initial_storage/public'))) {
            File::copyDirectory(resource_path('initial_storage/public'), storage_path('app/public'));
        }
    }
}
