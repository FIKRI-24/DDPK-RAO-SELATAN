@extends('layouts.app')

@section('title', 'Dashboard Siswa - Media Pembelajaran DDPK')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <span class="text-uppercase text-muted small fw-bold">Overview</span>
        <h2 class="fw-bold mb-0 text-dark">Dashboard</h2>
    </div>
</div>

<div class="row mb-4">
    <!-- Welcome Card -->
    <div class="col-md-6 col-lg-6 mb-4 mb-lg-0">
        <div class="card h-100 welcome-card">
            <div class="card-body p-4 d-flex align-items-center justify-content-between">
                <div class="pe-3">
                    <h3 class="fw-bold text-dark mb-2">Welcome back, {{ strtok($siswa->nama, ' ') }}</h3>
                    <p class="text-muted mb-4">Anda berada di panel Siswa Kelas <strong>{{ $siswa->kelas }}</strong>. Anda memiliki <strong class="text-danger">{{ $stats['belum_dikumpul'] }}</strong> tugas yang belum dikerjakan.</p>
                    <a href="{{ route('siswa.tugas.index') }}" class="btn btn-primary btn-sm px-3">Lihat Tugas &rarr;</a>
                </div>
                <div class="d-none d-sm-block">
                    <!-- SVG Illustration representing a student/learning -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="130" height="130" viewBox="0 0 200 200" class="welcome-illus">
                        <circle cx="100" cy="100" r="85" fill="#f8fafc" />
                        <!-- Book -->
                        <path d="M60 60 h70 a10 10 0 0 1 10 10 v70 a10 10 0 0 1 -10 10 h-70 z" fill="#206bc4" />
                        <path d="M50 70 h10 v70 h-10 z" fill="#1d4ed8" />
                        <!-- Pages -->
                        <path d="M65 70 h60" stroke="#ffffff" stroke-width="3" stroke-linecap="round" />
                        <path d="M65 85 h60" stroke="#ffffff" stroke-width="3" stroke-linecap="round" />
                        <path d="M65 100 h40" stroke="#ffffff" stroke-width="3" stroke-linecap="round" />
                        <!-- Graduation cap -->
                        <path d="M100 35 l25 10 l-25 10 l-25 -10 z" fill="#475569" />
                        <rect x="92" y="47" width="16" height="12" fill="#475569" />
                        <path d="M120 45 v15" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" />
                        <circle cx="120" cy="62" r="3" fill="#f59e0b" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Progress Card with Sparkline -->
    <div class="col-md-3 col-lg-3 mb-4 mb-lg-0">
        <div class="card h-100 p-4">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <span class="text-uppercase text-muted small fw-bold" style="font-size: 0.75rem;">Progres Tugas</span>
                    <h1 class="fw-bold text-dark display-6 mb-1 mt-1">{{ $stats['persentase_kumpul'] }}%</h1>
                </div>
                <span class="badge-trend badge-trend-up d-flex align-items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
                    <span>Aktif</span>
                </span>
            </div>
            <p class="text-muted small mb-3">Tugas dikumpulkan: {{ $stats['sudah_dikumpul'] }} dari {{ $stats['tugas_count'] }}</p>
            <div class="mt-auto pt-2">
                <!-- Sparkline SVG -->
                <svg class="sparkline-svg w-100" viewBox="0 0 100 30">
                    <path d="M0,20 Q20,5 40,25 T80,10 T100,5" fill="none" stroke="#206bc4" stroke-width="2" stroke-linecap="round" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Rata-rata Nilai Gauge Card -->
    <div class="col-md-3 col-lg-3">
        <div class="card h-100 p-4 text-center d-flex flex-column align-items-center justify-content-center">
            <span class="text-uppercase text-muted small fw-bold mb-3" style="font-size: 0.75rem;">Rata-rata Nilai</span>
            
            <div class="position-relative d-inline-flex mb-2">
                <!-- Circular gauge -->
                <svg class="progress-ring" width="80" height="80">
                    <circle class="progress-ring__background" stroke="#e2e8f0" stroke-width="8" fill="transparent" r="32" cx="40" cy="40"/>
                    <circle class="progress-ring__circle" stroke="#2fb344" stroke-width="8" fill="transparent" r="32" cx="40" cy="40"
                            stroke-dasharray="201" stroke-dashoffset="{{ $stats['rata_rata'] !== '-' ? (201 - (201 * $stats['rata_rata']) / 100) : 201 }}"/>
                </svg>
                <div class="position-absolute top-50 start-50 translate-middle">
                    <span class="fw-bold text-dark fs-5">{{ $stats['rata_rata'] }}</span>
                </div>
            </div>
            
            <span class="text-muted small mt-2">
                Dihitung dari {{ $stats['dinilai'] }} tugas dinilai
            </span>
        </div>
    </div>
</div>

<div class="row">
    <!-- Card Detail Metrics -->
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-box icon-box-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10"/><path d="M6 10h10"/></svg>
                </div>
                <div>
                    <h4 class="fw-bold text-dark mb-0">{{ $stats['materi_count'] }}</h4>
                    <span class="text-muted small">Materi Tersedia</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 mb-3">
        <div class="card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-box icon-box-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                </div>
                <div>
                    <h4 class="fw-bold text-dark mb-0">{{ $stats['tugas_count'] }}</h4>
                    <span class="text-muted small">Tugas Tersedia</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 mb-3">
        <div class="card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-box icon-box-info">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/></svg>
                </div>
                <div>
                    <h4 class="fw-bold text-dark mb-0">{{ $stats['sudah_dikumpul'] }}</h4>
                    <span class="text-muted small">Tugas Sudah Dikumpul</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 mb-3">
        <div class="card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-box icon-box-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <div>
                    <h4 class="fw-bold text-dark mb-0">{{ $stats['belum_dikumpul'] }}</h4>
                    <span class="text-muted small">Tugas Belum Dikumpul</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
