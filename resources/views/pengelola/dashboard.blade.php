@extends('layouts.pengelola')

@section('title', 'Dashboard Pengelola Desa - ' . $desa->nama_desa)
@section('page_title', 'Dashboard & Ringkasan Desa')

@section('content')
<!-- BANNER SAMBUTAN DESA -->
<div class="card border-0 rounded-4 shadow-sm mb-4 text-white overflow-hidden" style="background: linear-gradient(135deg, #155724 0%, #1e7e34 100%);">
    <div class="card-body p-4 p-md-5 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <span class="badge bg-light text-success fw-bold px-3 py-2 rounded-pill mb-2">
                <i class="bi bi-patch-check-fill"></i> Desa Wisata {{ $desa->status_desa }}
            </span>
            <h2 class="fw-bold mb-1">Desa Wisata {{ $desa->nama_desa }}</h2>
            <p class="mb-0 text-white-50">Kecamatan {{ $desa->kecamatan }} | Destinasi: <strong>{{ $desa->destinasi_unggulan }}</strong></p>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('pengelola.validasi') }}" class="btn btn-warning fw-semibold px-4 py-2 rounded-pill shadow-sm">
                <i class="bi bi-qr-code-scan me-1"></i> Scan Tiket Masuk
            </a>
            <a href="{{ route('pengelola.profil') }}" class="btn btn-outline-light fw-medium px-4 py-2 rounded-pill">
                <i class="bi bi-pencil me-1"></i> Atur Profil & Harga
            </a>
        </div>
    </div>
</div>

<!-- KARTU STATISTIK KUNJUNGAN & PENDAPATAN -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card-stat">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted small fw-bold">TOTAL PENGUNJUNG</span>
                <div class="bg-primary-subtle text-primary p-2 rounded-3">
                    <i class="bi bi-people-fill fs-5"></i>
                </div>
            </div>
            <h3 class="fw-bold mb-0 text-dark">{{ number_format($totalPengunjung) }}</h3>
            <small class="text-muted">Tiket lunas terjual</small>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card-stat">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted small fw-bold">PENGUNJUNG HARI INI</span>
                <div class="bg-info-subtle text-info p-2 rounded-3">
                    <i class="bi bi-calendar-check fs-5"></i>
                </div>
            </div>
            <h3 class="fw-bold mb-0 text-dark">{{ number_format($pengunjungHariIni) }}</h3>
            <small class="text-muted">Jadwal kunjungan hari ini</small>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card-stat">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted small fw-bold">TOTAL PENDAPATAN TIKET</span>
                <div class="bg-success-subtle text-success p-2 rounded-3">
                    <i class="bi bi-cash-stack fs-5"></i>
                </div>
            </div>
            <h3 class="fw-bold mb-0 text-success">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
            <small class="text-muted">Akumulasi penjualan e-tiket</small>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card-stat">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted small fw-bold">SALDO SIAP CAIR</span>
                <div class="bg-warning-subtle text-warning p-2 rounded-3">
                    <i class="bi bi-wallet2 fs-5"></i>
                </div>
            </div>
            <h3 class="fw-bold mb-0 text-dark">Rp {{ number_format($desa->saldo_tersedia, 0, ',', '.') }}</h3>
            <small class="text-muted"><a href="{{ route('pengelola.pencairan') }}" class="text-decoration-none">Ajukan Pencairan &rarr;</a></small>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- TABEL TIKET / PESANAN TERBARU DESA -->
    <div class="col-lg-8">
        <div class="card border-0 rounded-4 shadow-sm bg-white p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold text-dark mb-0">Pesanan Tiket Masuk Terbaru</h5>
                <a href="{{ route('pengelola.laporan') }}" class="btn btn-sm btn-outline-success rounded-pill px-3">Lihat Semua</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Kode Booking</th>
                            <th>Wisatawan</th>
                            <th>Tanggal Kunjungan</th>
                            <th>Tiket</th>
                            <th>Total</th>
                            <th>Status Tiket</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $ord)
                        <tr>
                            <td><code>{{ $ord->booking_code }}</code></td>
                            <td>
                                <strong>{{ $ord->full_name }}</strong><br>
                                <small class="text-muted">{{ $ord->whatsapp }}</small>
                            </td>
                            <td>{{ $ord->visit_date ? $ord->visit_date->format('d/m/Y') : '-' }}</td>
                            <td>{{ $ord->ticket_qty }} Tiket</td>
                            <td class="fw-semibold">Rp {{ number_format($ord->total_price, 0, ',', '.') }}</td>
                            <td>
                                @if($ord->ticket_status === 'used')
                                    <span class="badge bg-success-subtle text-success px-2 py-1 rounded-pill">
                                        <i class="bi bi-check-all"></i> Terpakai
                                    </span>
                                @elseif($ord->payment_status === 'lunas')
                                    <span class="badge bg-primary-subtle text-primary px-2 py-1 rounded-pill">
                                        <i class="bi bi-check-circle"></i> Siap Scan
                                    </span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning px-2 py-1 rounded-pill">
                                        {{ ucfirst($ord->payment_status) }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada pesanan tiket tercatat untuk desa ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- INFORMASI REKENING & PENCAIRAN CEPAT -->
    <div class="col-lg-4">
        <div class="card border-0 rounded-4 shadow-sm bg-white p-4 h-100">
            <h5 class="fw-bold text-dark mb-3">Rekening Kas / BUMDes</h5>
            <div class="p-3 bg-light rounded-3 mb-3 border">
                <div class="small text-muted mb-1">Bank Penerima:</div>
                <div class="fw-bold text-dark mb-2"><i class="bi bi-bank text-success me-1"></i> {{ $desa->nama_bank ?? 'Belum Diatur' }}</div>
                
                <div class="small text-muted mb-1">Nomor Rekening:</div>
                <div class="fw-bold text-dark font-monospace mb-2">{{ $desa->nomor_rekening ?? '-' }}</div>

                <div class="small text-muted mb-1">Atas Nama:</div>
                <div class="fw-bold text-dark">{{ $desa->atas_nama_rekening ?? '-' }}</div>
            </div>

            <div class="d-grid gap-2">
                <a href="{{ route('pengelola.rekening') }}" class="btn btn-outline-secondary rounded-pill btn-sm">
                    <i class="bi bi-pencil-square me-1"></i> Ubah Nomor Rekening
                </a>
                <a href="{{ route('pengelola.pencairan') }}" class="btn btn-success rounded-pill btn-sm">
                    <i class="bi bi-cash me-1"></i> Ajukan Pencairan Dana
                </a>
            </div>

            <hr class="my-3">

            <div class="small text-muted">
                <strong>Catatan Alur Keuangan:</strong>
                <p class="mb-0 mt-1">Pembayaran tiket dari wisatawan diverifikasi oleh Dispar. Saldo masuk ke kas desa wisata dan dapat diajukan pencairannya ke rekening bank desa kapan saja.</p>
            </div>
        </div>
    </div>
</div>
@endsection
