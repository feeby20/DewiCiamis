@extends('layouts.pengelola')

@section('title', 'Pencairan Dana Tiket - ' . $desa->nama_desa)
@section('page_title', 'Pencairan Dana Pendapatan Tiket')

@section('content')
<div class="row g-4 mb-4">
    <!-- KARTU SALDO & FORM PENCAIRAN -->
    <div class="col-lg-5">
        <div class="card border-0 rounded-4 shadow-sm bg-white p-4 h-100">
            <h5 class="fw-bold text-dark mb-3">Saldo Kas Desa</h5>

            <div class="p-4 rounded-4 mb-4 text-white" style="background: linear-gradient(135deg, #198754 0%, #157347 100%);">
                <span class="small text-white-50">SALDO SIAP DICAIRKAN</span>
                <h2 class="fw-bold my-1">Rp {{ number_format($desa->saldo_tersedia, 0, ',', '.') }}</h2>
                <div class="d-flex justify-content-between mt-3 pt-3 border-top border-white-50 small">
                    <span>Total Telah Dicairkan:</span>
                    <strong>Rp {{ number_format($desa->saldo_dicairkan, 0, ',', '.') }}</strong>
                </div>
            </div>

            <div class="p-3 bg-light rounded-3 mb-4 small border">
                <div class="d-flex justify-content-between mb-1">
                    <span class="text-muted">Bank Tujuan:</span>
                    <strong>{{ $desa->nama_bank ?? 'Belum Diatur' }}</strong>
                </div>
                <div class="d-flex justify-content-between mb-1">
                    <span class="text-muted">Nomor Rekening:</span>
                    <strong>{{ $desa->nomor_rekening ?? '-' }}</strong>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Atas Nama:</span>
                    <strong>{{ $desa->atas_nama_rekening ?? '-' }}</strong>
                </div>
            </div>

            @if(empty($desa->nomor_rekening))
                <div class="alert alert-warning small rounded-3 mb-3">
                    <i class="bi bi-exclamation-triangle-fill me-1"></i> Anda belum mengisi rekening bank desa. Silakan lengkapi pada menu <strong>Rekening Bank Desa</strong> terlebih dahulu.
                </div>
            @endif

            <form action="{{ route('pengelola.pencairan.request') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold small text-muted">Nominal Pencairan (Rp)</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light">Rp</span>
                        <input type="number" name="nominal" class="form-control fw-bold" placeholder="Contoh: 100000" min="10000" max="{{ max(10000, $desa->saldo_tersedia) }}" value="{{ old('nominal', $desa->saldo_tersedia) }}" required {{ $desa->saldo_tersedia < 10000 ? 'disabled' : '' }}>
                    </div>
                    <div class="form-text small">Minimal pencairan Rp 10.000.</div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold small text-muted">Catatan Permohonan (Opsional)</label>
                    <textarea name="catatan" class="form-control" rows="2" placeholder="Contoh: Pencairan hasil tiket periode minggu ke-1 November"></textarea>
                </div>

                <button type="submit" class="btn btn-success w-100 py-2 rounded-pill fw-semibold" {{ ($desa->saldo_tersedia < 10000 || empty($desa->nomor_rekening)) ? 'disabled' : '' }} onclick="return confirm('Kirim permohonan pencairan dana ini ke Admin Dinas Pariwisata?')">
                    <i class="bi bi-send-check me-1"></i> Ajukan Pencairan ke Dinas
                </button>
            </form>
        </div>
    </div>

    <!-- RIWAYAT PENCAIRAN DANA -->
    <div class="col-lg-7">
        <div class="card border-0 rounded-4 shadow-sm bg-white p-4 h-100">
            <h5 class="fw-bold text-dark mb-1">Riwayat Pengajuan Pencairan Dana</h5>
            <p class="text-muted small mb-3">Status konfirmasi transfer dana dari Dinas Pariwisata Kabupaten Ciamis.</p>

            <div class="table-responsive">
                <table class="table table-hover align-middle small">
                    <thead class="table-light">
                        <tr>
                            <th>Kode Permohonan</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                            <th>Status</th>
                            <th>Bukti Transfer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pencairanList as $item)
                        <tr>
                            <td>
                                <code>{{ $item->kode_pencairan }}</code><br>
                                <small class="text-muted">{{ $item->bank_tujuan }} ({{ $item->nomor_rekening }})</small>
                            </td>
                            <td>{{ $item->tanggal_pengajuan ? $item->tanggal_pengajuan->format('d/m/Y H:i') : '-' }}</td>
                            <td class="fw-bold text-success">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                            <td>
                                @if($item->status === 'disetujui')
                                    <span class="badge bg-success-subtle text-success px-2 py-1 rounded-pill">
                                        <i class="bi bi-check-circle"></i> Selesai Ditransfer
                                    </span>
                                @elseif($item->status === 'ditolak')
                                    <span class="badge bg-danger-subtle text-danger px-2 py-1 rounded-pill">
                                        <i class="bi bi-x-circle"></i> Ditolak
                                    </span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning px-2 py-1 rounded-pill">
                                        <i class="bi bi-clock-history"></i> Menunggu Konfirmasi
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($item->bukti_transfer && file_exists(public_path($item->bukti_transfer)))
                                    <a href="{{ asset($item->bukti_transfer) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill py-0 px-2">
                                        <i class="bi bi-file-earmark-image"></i> Lihat Resi
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada pengajuan pencairan dana yang diajukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $pencairanList->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
