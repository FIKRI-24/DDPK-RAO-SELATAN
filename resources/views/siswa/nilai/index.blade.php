@extends('layouts.app')

@section('title', 'Nilai & Progres - Siswa')

@section('content')
<!-- Page Header -->
<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <span class="text-uppercase text-primary small fw-bold tracking-wider">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="me-1"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
            Evaluasi Akademik
        </span>
        <h2 class="fw-bold mb-1 text-dark">Nilai & Progres Belajar Anda</h2>
        <p class="mb-0 fw-medium" style="color: #475569;">Pantau pencapaian nilai, ketuntasan tugas, dan catatan evaluasi dari Guru secara berkala.</p>
    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <a href="{{ route('siswa.tugas.index') }}" class="btn btn-primary btn-sm fw-semibold px-3 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
            Kerjakan Tugas &rarr;
        </a>
    </div>
</div>

<!-- Main Stats Section -->
<div class="row mb-4 g-3">
    <!-- Card Progress Bar -->
    <div class="col-lg-7 col-xl-8">
        <div class="card shadow-sm border-0 h-100 rounded-3 p-4 bg-white">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 bg-success bg-opacity-10 text-success rounded-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-dark">Ketuntasan Pengumpulan Tugas</h5>
                        <span class="small fw-medium" style="color: #64748b;">Perbandingan tugas selesai terhadap total tugas</span>
                    </div>
                </div>
                <div class="text-end">
                    <span class="display-6 fw-extrabold text-success mb-0">{{ $stats['persentase'] }}%</span>
                </div>
            </div>

            <!-- Custom Progress Bar with rounded glow -->
            <div class="progress mb-3" style="height: 14px; border-radius: 10px; background-color: #e2e8f0;">
                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" 
                     role="progressbar" 
                     style="width: {{ $stats['persentase'] }}%; border-radius: 10px;" 
                     aria-valuenow="{{ $stats['persentase'] }}" 
                     aria-valuemin="0" 
                     aria-valuemax="100">
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-between align-items-center pt-2 border-top">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-success bg-opacity-10 text-success px-2 py-1 fw-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="me-1"><polyline points="20 6 9 17 4 12"/></svg>
                        {{ $stats['dikumpul'] }} Dikumpulkan
                    </span>
                    <span class="badge bg-secondary bg-opacity-10 text-secondary px-2 py-1 fw-bold">
                        {{ $stats['total_tugas'] }} Total Tugas
                    </span>
                </div>
                <p class="mb-0 small fw-medium" style="color: #334155;">
                    Sisa <strong class="text-danger">{{ $stats['belum_dikumpul'] }} tugas</strong> yang belum Anda kumpulkan.
                </p>
            </div>
        </div>
    </div>

    <!-- Card Rata-rata Nilai -->
    <div class="col-lg-5 col-xl-4">
        <div class="card shadow-sm border-0 h-100 rounded-3 p-4 text-white text-center position-relative overflow-hidden" 
             style="background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);">
            
            <div class="d-inline-flex align-items-center justify-content-center bg-white bg-opacity-20 text-white rounded-pill px-3 py-1 mb-2 mx-auto small fw-bold tracking-wider">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="me-1"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                RATA-RATA NILAI ANDA
            </div>

            <div class="my-2">
                <span class="display-3 fw-extrabold text-white tracking-tight">{{ $stats['rata_rata'] }}</span>
            </div>

            <p class="small text-white fw-medium mb-0" style="line-height: 1.4;">
                Dihitung dari <strong>{{ $stats['dinilai'] }} tugas</strong> yang telah diperiksa & dinilai oleh Guru.
            </p>
        </div>
    </div>
</div>

<!-- 4 Status Metric Cards -->
<div class="row mb-4 g-3">
    <div class="col-6 col-md-3">
        <div class="card shadow-sm border-0 h-100 p-3 rounded-3 bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10"/><path d="M6 10h10"/></svg>
                </div>
                <div>
                    <span class="small fw-bold text-uppercase d-block" style="color: #64748b; font-size: 0.75rem;">Tugas Tersedia</span>
                    <h3 class="fw-bold text-dark mb-0 mt-0">{{ $stats['total_tugas'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="card shadow-sm border-0 h-100 p-3 rounded-3 bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="p-3 bg-info bg-opacity-10 text-info rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/></svg>
                </div>
                <div>
                    <span class="small fw-bold text-uppercase d-block" style="color: #64748b; font-size: 0.75rem;">Sudah Dikumpul</span>
                    <h3 class="fw-bold text-info mb-0 mt-0">{{ $stats['dikumpul'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="card shadow-sm border-0 h-100 p-3 rounded-3 bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="p-3 bg-danger bg-opacity-10 text-danger rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div>
                    <span class="small fw-bold text-uppercase d-block" style="color: #64748b; font-size: 0.75rem;">Belum Dikumpul</span>
                    <h3 class="fw-bold text-danger mb-0 mt-0">{{ $stats['belum_dikumpul'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="card shadow-sm border-0 h-100 p-3 rounded-3 bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="p-3 bg-success bg-opacity-10 text-success rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                </div>
                <div>
                    <span class="small fw-bold text-uppercase d-block" style="color: #64748b; font-size: 0.75rem;">Sudah Dinilai</span>
                    <h3 class="fw-bold text-success mb-0 mt-0">{{ $stats['dinilai'] }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Tabel Daftar Tugas & Nilai --}}
<div class="card shadow-sm border-0 rounded-3 overflow-hidden bg-white mb-4">
    <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <div class="p-2 bg-primary bg-opacity-10 text-primary rounded-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
            </div>
            <h5 class="fw-bold mb-0 text-dark">Rincian Nilai per Tugas</h5>
        </div>
        <span class="badge bg-light text-dark fw-bold border px-3 py-2">
            Total: {{ $tugas->count() }} Tugas
        </span>
    </div>
    <div class="card-body p-0">
        @if($tugas->isEmpty())
            <div class="text-center py-5">
                <div class="mb-2 fs-1 text-muted">📝</div>
                <h6 class="fw-bold text-dark mb-1">Belum Ada Tugas</h6>
                <p class="small text-muted mb-0">Guru belum memberikan tugas pembelajaran untuk kelas Anda.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light" style="border-bottom: 2px solid #e2e8f0;">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase fw-bold text-secondary" style="width: 5%; font-size: 0.8rem;">No</th>
                            <th class="py-3 text-uppercase fw-bold text-secondary" style="width: 38%; font-size: 0.8rem;">Nama Tugas & Materi</th>
                            <th class="py-3 text-uppercase fw-bold text-secondary" style="width: 20%; font-size: 0.8rem;">Guru Pengampu</th>
                            <th class="py-3 text-uppercase fw-bold text-secondary text-center" style="width: 17%; font-size: 0.8rem;">Status Pengumpulan</th>
                            <th class="pe-4 py-3 text-uppercase fw-bold text-secondary text-end" style="width: 20%; font-size: 0.8rem;">Skor & Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tugas as $index => $item)
                            <tr>
                                <td class="ps-4 fw-bold text-muted">{{ $index + 1 }}</td>
                                <td class="py-3">
                                    <div class="fw-bold text-dark fs-6">{{ $item->nama_tugas }}</div>
                                    <div class="small fw-medium mt-1" style="color: #64748b;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1 text-primary"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10"/><path d="M6 10h10"/></svg>
                                        Materi: <strong>{{ $item->materi->judul }}</strong>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark small d-flex align-items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-secondary"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                        {{ $item->materi->guru->nama ?? 'Guru Pengampu' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if($item->status == 'Sudah Dinilai')
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2 rounded-pill fw-bold small">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="me-1"><polyline points="20 6 9 17 4 12"/></svg>
                                            Sudah Dinilai
                                        </span>
                                    @elseif($item->status == 'Sudah Dikumpulkan')
                                        <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 px-3 py-2 rounded-pill fw-bold small">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="me-1"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                            Menunggu Penilaian
                                        </span>
                                    @else
                                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-3 py-2 rounded-pill fw-bold small">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="me-1"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                            Belum Mengumpulkan
                                        </span>
                                    @endif
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="d-flex justify-content-end align-items-center gap-3">
                                        @if($item->status == 'Sudah Dinilai')
                                            <div class="text-end">
                                                <span class="fs-4 fw-extrabold text-success">{{ $item->nilai }}</span>
                                                <span class="small text-muted d-block" style="font-size: 0.7rem;">/ 100</span>
                                            </div>
                                        @elseif($item->status == 'Sudah Dikumpulkan')
                                            <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 fw-bold px-2 py-1 small">Proses</span>
                                        @else
                                            <span class="text-muted fw-bold">-</span>
                                        @endif
                                        
                                        <a href="{{ route('siswa.nilai.show', $item->id_tugas) }}" class="btn btn-sm btn-outline-primary fw-semibold px-3 rounded-2">
                                            Lihat Detail &rarr;
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
