@extends('layouts.app')

@section('title', 'Penilaian Tugas - Panel Guru')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-0 text-dark">Penilaian Tugas Siswa</h2>
        <p class="text-muted">Pilih tugas untuk melihat daftar pengumpulan jawaban siswa dan memberikan nilai</p>
    </div>
</div>

{{-- Success Alert --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        @if($tugas->isEmpty())
            <div class="text-center py-5">
                <div class="text-muted fs-1 mb-3">📝</div>
                <h5 class="fw-bold">Belum ada tugas pembelajaran</h5>
                <p class="text-muted px-4">Buat materi dan tugas terlebih dahulu untuk menerima pengumpulan berkas dari siswa.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" style="width: 5%">No</th>
                            <th style="width: 40%">Nama Tugas</th>
                            <th style="width: 25%">Materi Terkait</th>
                            <th style="width: 15%">Status Pengumpulan</th>
                            <th class="pe-4 text-end" style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tugas as $index => $item)
                            <tr>
                                <td class="ps-4 fw-medium text-secondary">{{ $index + 1 }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $item->nama_tugas }}</div>
                                    <div class="small text-muted">Dibuat: {{ $item->created_at->format('d M Y') }}</div>
                                </td>
                                <td class="text-dark fw-medium">{{ $item->materi->judul ?? '-' }}</td>
                                <td>
                                    <div class="d-flex flex-column gap-1">
                                        <span class="badge bg-secondary small text-start">📥 Dikumpul: {{ $item->dikumpul_count }} siswa</span>
                                        <span class="badge bg-success small text-start">✔️ Dinilai: {{ $item->dinilai_count }} siswa</span>
                                        @if($item->belum_dinilai_count > 0)
                                            <span class="badge bg-warning text-dark small text-start">⏳ Belum Dinilai: {{ $item->belum_dinilai_count }} siswa</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="pe-4 text-end">
                                    <a href="{{ route('guru.penilaian.show', $item->id_tugas) }}" class="btn btn-primary btn-sm">
                                        Evaluasi Jawaban &rarr;
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
