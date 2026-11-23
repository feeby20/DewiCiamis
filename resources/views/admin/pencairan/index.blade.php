@extends('layouts.admin')

@section('title', 'Rekap & Konfirmasi Pencairan Dana Desa')
@section('page_title', 'Rekap & Konfirmasi Pencairan Dana ke Desa Wisata')

@section('content')
<!-- KARTU STATISTIK PENCAIRAN DANA -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
            <span class="text-muted small fw-semibold">TOTAL PERMOHONAN</span>
            <h2 class="fw-bold text-dark my-1">{{ number_format($totalPengajuan) }}</h2>
            <small class="text-muted">Seluruh riwayat pengajuan</small>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
            <span class="text-muted small fw-semibold">MENUNGGU KONFIRMASI</span>
            <h2 class="fw-bold text-warning my-1">{{ number_format($totalMenunggu) }}</h2>
            <small class="text-warning fw-semibold">Rp {{ number_format($nominalMenunggu, 0, ',', '.') }} perlu dicairkan</small>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
            <span class="text-muted small fw-semibold">TOTAL DANA DICAIRKAN</span>
            <h2 class="fw-bold text-success my-1">Rp {{ number_format($totalNominalDicairkan, 0, ',', '.') }}</h2>
            <small class="text-muted">Telah ditransfer ke rekening desa</small>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
            <span class="text-muted small fw-semibold">BANK TUJUAN DESA</span>
            <h2 class="fw-bold text-primary my-1">57 Desa</h2>
            <small class="text-muted">BJB, BRI, BCA, Mandiri</small>
        </div>
    </div>
</div>

<div class="card border-0 rounded-4 shadow-sm bg-white p-4">
    <!-- FILTER -->
    <form method="GET" action="{{ route('admin.pencairan.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <select name="status" class="form-select">
                <option value="">Semua Status Pencairan</option>
                <option value="menunggu" {{ request('status') === 'menunggu' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                <option value="disetujui" {{ request('status') === 'disetujui' ? 'selected' : '' }}>Disetujui / Selesai</option>
                <option value="ditolak" {{ request('status') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>
        <div class="col-md-5">
            <select name="desa_id" class="form-select">
                <option value="">Semua Desa Wisata</option>
                @foreach($desaList as $d)
                    <option value="{{ $d->id }}" {{ request('desa_id') == $d->id ? 'selected' : '' }}>{{ $d->nama_desa }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-success rounded-pill w-100">
                <i class="bi bi-filter"></i> Filter
            </button>
            <a href="{{ route('admin.pencairan.index') }}" class="btn btn-outline-secondary rounded-pill">Reset</a>
        </div>
    </form>

    <!-- TABEL PENCAIRAN -->
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Kode Pengajuan</th>
                    <th>Desa Wisata</th>
                    <th>Nominal</th>
                    <th>Rekening Tujuan Desa</th>
                    <th>Tgl Pengajuan</th>
                    <th>Status</th>
                    <th>Aksi Admin Dispar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pencairanList as $item)
                <tr>
                    <td><code>{{ $item->kode_pencairan }}</code></td>
                    <td>
                        <strong>{{ $item->desa->nama_desa ?? '-' }}</strong><br>
                        <small class="text-muted">Pengelola: {{ $item->pengelola->name ?? '-' }}</small>
                    </td>
                    <td class="fw-bold text-success fs-6">
                        Rp {{ number_format($item->nominal, 0, ',', '.') }}
                    </td>
                    <td>
                        <span class="fw-semibold">{{ $item->bank_tujuan }}</span><br>
                        <code class="small">{{ $item->nomor_rekening }}</code><br>
                        <small class="text-muted">a.n {{ $item->atas_nama }}</small>
                    </td>
                    <td>{{ $item->tanggal_pengajuan ? $item->tanggal_pengajuan->format('d/m/Y H:i') : '-' }}</td>
                    <td>
                        @if($item->status === 'disetujui')
                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                <i class="bi bi-check-circle-fill me-1"></i> Telah Dicairkan
                            </span>
                        @elseif($item->status === 'ditolak')
                            <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">
                                <i class="bi bi-x-circle-fill me-1"></i> Ditolak
                            </span>
                        @else
                            <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill">
                                <i class="bi bi-clock-fill me-1"></i> Menunggu Konfirmasi
                            </span>
                        @endif
                    </td>
                    <td>
                        @if($item->status === 'menunggu')
                            <button type="button" class="btn btn-sm btn-primary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalKonfirmasi{{ $item->id }}">
                                <i class="bi bi-cash-coin me-1"></i> Konfirmasi Transfer
                            </button>

                            <!-- MODAL KONFIRMASI PENCAIRAN -->
                            <div class="modal fade" id="modalKonfirmasi{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content rounded-4 border-0 shadow">
                                        <div class="modal-header border-0 pb-0">
                                            <h5 class="modal-title fw-bold">Konfirmasi Pencairan Dana</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.pencairan.konfirmasi', $item->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="p-3 bg-light rounded-3 mb-3 border">
                                                    <div class="small text-muted">Desa Tujuan:</div>
                                                    <div class="fw-bold mb-1">{{ $item->desa->nama_desa }}</div>
                                                    <div class="small text-muted">Nominal Transfer:</div>
                                                    <div class="fs-5 fw-bold text-success mb-1">Rp {{ number_format($item->nominal, 0, ',', '.') }}</div>
                                                    <div class="small text-muted">Rekening Penerima:</div>
                                                    <div class="fw-semibold">{{ $item->bank_tujuan }} - {{ $item->nomor_rekening }} (a.n {{ $item->atas_nama }})</div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold small">Keputusan</label>
                                                    <select name="status" class="form-select" required>
                                                        <option value="disetujui">Setujui & Konfirmasi Telah Ditransfer</option>
                                                        <option value="ditolak">Tolak Permohonan (Kembalikan Saldo ke Desa)</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold small">Unggah Bukti Transfer / Resi (Jika Disetujui)</label>
                                                    <input type="file" name="bukti_transfer" class="form-control" accept="image/*,application/pdf">
                                                    <div class="form-text small">Foto atau struk bukti transfer dari bank Dinas Pariwisata.</div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold small">Catatan Admin Dinas (Opsional)</label>
                                                    <textarea name="catatan_admin" class="form-control" rows="2" placeholder="Contoh: Dana telah ditransfer via Bank BJB Kasda"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0 pt-0">
                                                <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-success rounded-pill px-4 fw-semibold">Simpan Konfirmasi</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            @if($item->bukti_transfer && file_exists(public_path($item->bukti_transfer)))
                                <a href="{{ asset($item->bukti_transfer) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="bi bi-image me-1"></i> Resi Transfer
                                </a>
                            @else
                                <span class="text-muted small">Selesai</span>
                            @endif
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">Belum ada data pengajuan pencairan dana.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $pencairanList->withQueryString()->links() }}
    </div>
</div>
@endsection
