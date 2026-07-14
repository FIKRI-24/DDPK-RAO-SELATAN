@extends('layouts.app')

@section('title', 'Detail Tugas - Panel Guru')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-0 text-dark">Detail Tugas Pembelajaran</h2>
        <p class="text-muted">Melihat informasi tugas serta memantau status pengumpulan siswa</p>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <h3 class="fw-bold text-primary mb-2">{{ $tugas->nama_tugas }}</h3>
                <div class="mb-4 d-flex flex-wrap gap-3 text-secondary border-bottom pb-3">
                    <div>
                        📖 Materi: <strong>{{ $tugas->materi->judul ?? '-' }}</strong>
                    </div>
                    <div>
                        📅 Dibuat: <strong>{{ $tugas->created_at->format('d M Y H:i') }}</strong>
                    </div>
                </div>

                <div class="fs-5 mb-4 text-dark" style="white-space: pre-line; line-height: 1.6;">
                    {!! nl2br(e($tugas->deskripsi)) !!}
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('guru.tugas.edit', $tugas->id_tugas) }}" class="btn btn-warning px-4">
                        Edit Tugas
                    </a>
                    <a href="{{ route('guru.tugas.index') }}" class="btn btn-outline-secondary px-4">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Status Pengumpulan Siswa --}}
<div class="row">
    {{-- Sudah Mengumpulkan --}}
    <div class="col-lg-6 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-success text-white py-3 px-4">
                <h5 class="mb-0 fw-bold">✔️ Sudah Mengumpulkan ({{ $hasil->count() }})</h5>
            </div>
            <div class="card-body p-0">
                @if($hasil->isEmpty())
                    <div class="text-center py-5 text-muted">
                        Belum ada siswa yang mengumpulkan jawaban.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr class="table-light">
                                    <th class="ps-4">Siswa</th>
                                    <th>Waktu Kumpul</th>
                                    <th class="pe-4 text-end">Jawaban</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hasil as $item)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="fw-bold">{{ $item->siswa->nama }}</div>
                                            <div class="small text-muted">NISN: {{ $item->siswa->nisn ?? '-' }} (Kelas: {{ $item->siswa->kelas }})</div>
                                        </td>
                                        <td class="small text-secondary">
                                            {{ $item->tgl_kumpul ? \Carbon\Carbon::parse($item->tgl_kumpul)->format('d M Y H:i') : '-' }}
                                        </td>
                                        <td class="pe-4 text-end">
                                            <a href="{{ Storage::url($item->file_jawaban) }}" target="_blank" class="btn btn-sm btn-primary">
                                                Unduh Jawaban
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
    </div>

    {{-- Belum Mengumpulkan --}}
    <div class="col-lg-6 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-warning text-dark py-3 px-4">
                <h5 class="mb-0 fw-bold">⏳ Belum Mengumpulkan ({{ $siswaBelum->count() }})</h5>
            </div>
            <div class="card-body p-0">
                @if($siswaBelum->isEmpty())
                    <div class="text-center py-5 text-muted">
                        Semua siswa telah mengumpulkan tugas.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr class="table-light">
                                    <th class="ps-4">Siswa</th>
                                    <th class="pe-4">Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($siswaBelum as $item)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="fw-bold">{{ $item->nama }}</div>
                                            <div class="small text-muted">NISN: {{ $item->nisn ?? '-' }}</div>
                                        </td>
                                        <td class="pe-4 text-secondary">
                                            {{ $item->kelas }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
