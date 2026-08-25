@extends('layouts.app')

@section('title', 'Detail Progres Siswa - Panel Guru')

@section('content')
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-0 text-dark">Detail Progres Siswa</h2>
            <p class="text-muted mb-0">Siswa: <strong>{{ $siswa->nama }}</strong> | Kelas: {{ $siswa->kelas }} | Rata-rata Nilai: <strong class="text-success">{{ $rata_rata }}</strong></p>
        </div>
        <a href="{{ route('guru.rekap.index') }}" class="btn btn-outline-secondary">
            &larr; Kembali
        </a>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        @if($tugas->isEmpty())
            <div class="text-center py-5 text-muted">
                Belum ada tugas pembelajaran yang dibuat.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" style="width: 5%">No</th>
                            <th style="width: 35%">Nama Tugas</th>
                            <th style="width: 25%">Status</th>
                            <th style="width: 25%">Berkas Jawaban</th>
                            <th class="pe-4 text-end" style="width: 10%">Nilai</th>
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
                                <td>
                                    @if($item->status == 'Sudah Dinilai')
                                        <span class="badge bg-success">✔️ Sudah Dinilai</span>
                                    @elseif($item->status == 'Sudah Dikumpulkan')
                                        <span class="badge bg-info text-white">📥 Sudah Dikumpulkan</span>
                                    @else
                                        <span class="badge bg-warning text-dark">⏳ Belum Dikumpulkan</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->file_jawaban)
                                        <div class="d-flex align-items-center">
                                            <span class="small text-truncate me-2" style="max-width: 150px;">
                                                📂 {{ basename($item->file_jawaban) }}
                                            </span>
                                            <a href="{{ route('jawaban.unduh', $item->id_hasil) }}" target="_blank" class="btn btn-sm btn-link py-0">
                                                Unduh
                                            </a>
                                        </div>
                                        <div class="small text-muted mt-1">
                                            Kumpul: {{ \Carbon\Carbon::parse($item->tgl_kumpul)->format('d M Y H:i') }}
                                        </div>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td class="pe-4 text-end fw-bold">
                                    @if($item->nilai !== null)
                                        <span class="text-success">{{ $item->nilai }}</span>
                                    @elseif($item->status == 'Sudah Dikumpulkan')
                                        <span class="text-warning small fw-semibold">Belum Dinilai</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
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
