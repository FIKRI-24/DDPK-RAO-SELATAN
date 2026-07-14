@extends('layouts.app')

@section('title', 'Evaluasi Tugas - Panel Guru')

@section('content')
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-0 text-dark">Daftar Pengumpulan Jawaban</h2>
            <p class="text-muted mb-0">Tugas: <strong>{{ $tugas->nama_tugas }}</strong> (Materi: {{ $tugas->materi->judul }})</p>
        </div>
        <a href="{{ route('guru.penilaian.index') }}" class="btn btn-outline-secondary">
            &larr; Kembali
        </a>
    </div>
</div>

{{-- Success/Error Alerts --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        @if($hasil->isEmpty())
            <div class="text-center py-5">
                <div class="text-muted fs-1 mb-3">📂</div>
                <h5 class="fw-bold">Belum ada pengumpulan jawaban</h5>
                <p class="text-muted px-4">Siswa belum mengunggah file jawaban untuk tugas ini.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" style="width: 5%">No</th>
                            <th style="width: 30%">Nama Siswa</th>
                            <th style="width: 25%">File Jawaban</th>
                            <th style="width: 15%">Waktu Kumpul</th>
                            <th style="width: 10%">Nilai</th>
                            <th class="pe-4 text-end" style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hasil as $index => $item)
                            <tr>
                                <td class="ps-4 fw-medium text-secondary">{{ $index + 1 }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $item->siswa->nama }}</div>
                                    <div class="small text-muted">NISN: {{ $item->siswa->nisn ?? '-' }} | Kelas: {{ $item->siswa->kelas }}</div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="small text-truncate me-2" style="max-width: 180px;">
                                            📂 {{ basename($item->file_jawaban) }}
                                        </span>
                                        <a href="{{ Storage::url($item->file_jawaban) }}" target="_blank" class="btn btn-sm btn-link py-0">
                                            Unduh
                                        </a>
                                    </div>
                                </td>
                                <td class="small text-secondary">
                                    {{ \Carbon\Carbon::parse($item->tgl_kumpul)->format('d M Y H:i') }}
                                </td>
                                <td>
                                    @if($item->nilai !== null)
                                        <span class="badge bg-success fs-6">{{ $item->nilai }}</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Belum Dinilai</span>
                                    @endif
                                </td>
                                <td class="pe-4 text-end">
                                    <a href="{{ route('guru.penilaian.edit', $item->id_hasil) }}" class="btn btn-outline-primary btn-sm">
                                        {{ $item->nilai !== null ? 'Edit Nilai' : 'Beri Nilai' }}
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
