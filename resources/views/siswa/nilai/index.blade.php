@extends('layouts.app')

@section('title', 'Nilai & Progres - Siswa')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-0 text-dark">Nilai & Progres Belajar Anda</h2>
        <p class="text-muted">Pantau pencapaian akademis dan status pengumpulan tugas Anda</p>
    </div>
</div>

<div class="row">
    <!-- Card Progress Bar -->
    <div class="col-lg-8 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body p-4">
                <h5 class="fw-bold text-dark mb-3">Persentase Pengumpulan Tugas</h5>
                <div class="d-flex align-items-center mb-3">
                    <div class="progress w-100 me-3" style="height: 20px;">
                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ $stats['persentase'] }}%" aria-valuenow="{{ $stats['persentase'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <span class="fs-4 fw-bold text-success">{{ $stats['persentase'] }}%</span>
                </div>
                <p class="text-muted mb-0">
                    Anda telah mengumpulkan <strong>{{ $stats['dikumpul'] }}</strong> tugas dari total <strong>{{ $stats['total_tugas'] }}</strong> tugas yang tersedia.
                </p>
            </div>
        </div>
    </div>

    <!-- Card Rata-rata Nilai -->
    <div class="col-lg-4 mb-4">
        <div class="card shadow-sm border-0 h-100 bg-primary text-white">
            <div class="card-body p-4 d-flex flex-column justify-content-center text-center">
                <h6 class="text-uppercase text-white-50 fw-bold mb-2">Rata-rata Nilai Anda</h6>
                <h1 class="fw-bold display-4 mb-0">{{ $stats['rata_rata'] }}</h1>
                <p class="small text-white-50 mt-2 mb-0">Rata-rata dihitung dari {{ $stats['dinilai'] }} tugas yang sudah dinilai</p>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <!-- Ringkasan Kartu -->
    <div class="col-12">
        <div class="row">
            <div class="col-6 col-md-3 mb-3">
                <div class="card shadow-sm border-0 text-center p-3">
                    <span class="text-muted small text-uppercase fw-bold">Tugas Tersedia</span>
                    <h3 class="fw-bold text-dark mb-0 mt-1">{{ $stats['total_tugas'] }}</h3>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-3">
                <div class="card shadow-sm border-0 text-center p-3">
                    <span class="text-muted small text-uppercase fw-bold">Sudah Dikumpul</span>
                    <h3 class="fw-bold text-info mb-0 mt-1">{{ $stats['dikumpul'] }}</h3>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-3">
                <div class="card shadow-sm border-0 text-center p-3">
                    <span class="text-muted small text-uppercase fw-bold">Belum Dikumpul</span>
                    <h3 class="fw-bold text-secondary mb-0 mt-1">{{ $stats['belum_dikumpul'] }}</h3>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-3">
                <div class="card shadow-sm border-0 text-center p-3">
                    <span class="text-muted small text-uppercase fw-bold">Sudah Dinilai</span>
                    <h3 class="fw-bold text-success mb-0 mt-1">{{ $stats['dinilai'] }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Tabel Daftar Tugas & Nilai --}}
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 px-4">
        <h5 class="fw-bold mb-0 text-dark">Rincian Tugas & Nilai</h5>
    </div>
    <div class="card-body p-0">
        @if($tugas->isEmpty())
            <div class="text-center py-5 text-muted">
                Belum ada tugas pembelajaran.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" style="width: 5%">No</th>
                            <th style="width: 45%">Nama Tugas</th>
                            <th style="width: 20%">Guru Pengampu</th>
                            <th style="width: 15%">Status</th>
                            <th class="pe-4 text-end" style="width: 15%">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tugas as $index => $item)
                            <tr>
                                <td class="ps-4 fw-medium text-secondary">{{ $index + 1 }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $item->nama_tugas }}</div>
                                    <div class="small text-muted">Materi: {{ $item->materi->judul }}</div>
                                </td>
                                <td class="text-secondary small">{{ $item->materi->guru->nama ?? 'Guru' }}</td>
                                <td>
                                    @if($item->status == 'Sudah Dinilai')
                                        <span class="badge bg-success">Sudah Dinilai</span>
                                    @elseif($item->status == 'Sudah Dikumpulkan')
                                        <span class="badge bg-info text-white">Sudah Dikumpulkan</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Belum Dikumpulkan</span>
                                    @endif
                                </td>
                                <td class="pe-4 text-end fw-bold">
                                    <div class="d-flex justify-content-end align-items-center gap-2">
                                        @if($item->status == 'Sudah Dinilai')
                                            <span class="text-success fs-5">{{ $item->nilai }}</span>
                                        @elseif($item->status == 'Sudah Dikumpulkan')
                                            <span class="text-warning small fw-semibold">Belum Dinilai</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                        <a href="{{ route('siswa.nilai.show', $item->id_tugas) }}" class="btn btn-sm btn-outline-secondary py-0">
                                            Detail &rarr;
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
