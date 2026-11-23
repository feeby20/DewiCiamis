@extends('layouts.pengelola')

@section('title', 'Laporan Pendapatan Tiket - ' . $desa->nama_desa)
@section('page_title', 'Laporan Pendapatan & Kunjungan Tiket')

@section('content')
<!-- KARTU RINGKASAN -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card-stat">
            <span class="text-muted small fw-bold">TOTAL PENDAPATAN TIKET</span>
            <h3 class="fw-bold text-success mb-1">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
            <small class="text-muted">Total dari pesanan lunas</small>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card-stat">
            <span class="text-muted small fw-bold">TOTAL WISATAWAN MASUK</span>
            <h3 class="fw-bold text-dark mb-1">{{ number_format($totalTiket) }} Orang</h3>
            <small class="text-muted">Akumulasi seluruh pemesanan</small>
        </div>
    </div>
</div>

<div class="card border-0 rounded-4 shadow-sm bg-white p-4">
    <!-- FILTER LAPORAN -->
    <form method="GET" action="{{ route('pengelola.laporan') }}" class="row g-3 mb-4">
        <div class="col-md-3">
            <label class="form-label small text-muted">Status Pembayaran</label>
            <select name="status" class="form-select form-select-sm">
                <option value="">Semua Status</option>
                <option value="lunas" {{ request('status') === 'lunas' ? 'selected' : '' }}>Lunas</option>
                <option value="menunggu" {{ request('status') === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="ditolak" {{ request('status') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label small text-muted">Tanggal Mulai</label>
            <input type="date" name="start_date" class="form-control form-select-sm" value="{{ request('start_date') }}">
        </div>
        <div class="col-md-3">
            <label class="form-label small text-muted">Tanggal Selesai</label>
            <input type="date" name="end_date" class="form-control form-select-sm" value="{{ request('end_date') }}">
        </div>
        <div class="col-md-3 d-flex align-items-end gap-2">
            <button type="submit" class="btn btn-sm btn-success rounded-pill px-3">
                <i class="bi bi-filter"></i> Filter
            </button>
            <a href="{{ route('pengelola.laporan') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">Reset</a>
        </div>
    </form>

    <!-- TABEL TRANSAKSI -->
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Waktu Pesan</th>
                    <th>Kode Booking</th>
                    <th>Nama Wisatawan</th>
                    <th>No. WhatsApp</th>
                    <th>Tgl Kunjungan</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Pembayaran</th>
                    <th>Status Tiket</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $ord)
                <tr>
                    <td>{{ $ord->created_at ? $ord->created_at->format('d/m/Y H:i') : '-' }}</td>
                    <td><code>{{ $ord->booking_code }}</code></td>
                    <td><strong>{{ $ord->full_name }}</strong></td>
                    <td>{{ $ord->whatsapp }}</td>
                    <td>{{ $ord->visit_date ? $ord->visit_date->format('d/m/Y') : '-' }}</td>
                    <td>{{ $ord->ticket_qty }} Tiket</td>
                    <td class="fw-bold">Rp {{ number_format($ord->total_price, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge {{ $ord->payment_status === 'lunas' ? 'bg-success' : ($ord->payment_status === 'ditolak' ? 'bg-danger' : 'bg-warning text-dark') }} px-2 py-1 rounded-pill">
                            {{ ucfirst($ord->payment_status) }}
                        </span>
                    </td>
                    <td>
                        @if($ord->ticket_status === 'used')
                            <span class="badge bg-success-subtle text-success">
                                <i class="bi bi-check-all"></i> Terpakai
                            </span>
                        @else
                            <span class="badge bg-secondary-subtle text-secondary">Belum Scan</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-4 text-muted">Tidak ada data transaksi tiket yang sesuai dengan filter.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $orders->withQueryString()->links() }}
    </div>
</div>
@endsection
