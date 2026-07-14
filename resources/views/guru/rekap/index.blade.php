@extends('layouts.app')

@section('title', 'Rekap Progres - Panel Guru')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-0 text-dark">Rekap Progres Belajar Siswa</h2>
        <p class="text-muted">Pantau persentase pengumpulan tugas dan nilai rata-rata seluruh siswa untuk tugas Anda</p>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        @if($siswa->isEmpty())
            <div class="text-center py-5 text-muted">
                Belum ada data siswa terdaftar.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" style="width: 5%">No</th>
                            <th style="width: 25%">Nama Siswa</th>
                            <th style="width: 15%">Kelas</th>
                            <th style="width: 25%">Progres Pengumpulan</th>
                            <th style="width: 15%">Rata-rata Nilai</th>
                            <th class="pe-4 text-end" style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswa as $index => $item)
                            <tr>
                                <td class="ps-4 fw-medium text-secondary">{{ $index + 1 }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $item->nama }}</div>
                                    <div class="small text-muted">NISN: {{ $item->nisn ?? '-' }}</div>
                                </td>
                                <td><span class="badge bg-secondary">{{ $item->kelas }}</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="progress w-100 me-2" style="height: 8px;">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $item->persentase }}%" aria-valuenow="{{ $item->persentase }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="small fw-bold text-secondary">{{ $item->persentase }}%</span>
                                    </div>
                                    <div class="small text-muted mt-1">
                                        Dikumpul: {{ $item->tugas_dikumpul }} dari {{ $item->total_tugas }} tugas
                                    </div>
                                </td>
                                <td>
                                    @if($item->rata_rata !== '-')
                                        <span class="badge bg-success fs-6">{{ $item->rata_rata }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="pe-4 text-end">
                                    <a href="{{ route('guru.rekap.show', $item->id_siswa) }}" class="btn btn-outline-info btn-sm">
                                        Detail Progres
                                    </a>
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
