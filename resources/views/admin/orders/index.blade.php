@extends('layouts.admin')

@section('title', 'Data Pesanan Tiket - Admin DewiCiamis')
@section('page_title', 'Kelola Semua Pesanan')

@section('content')
<!-- Filter Box -->
<div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
    <form action="{{ route('admin.orders.index') }}" method="GET" class="row g-3">
        <div class="col-md-4">
            <label class="form-label small fw-semibold">Pencarian</label>
            <input type="text" name="q" class="form-control" placeholder="Kode booking, nama, no WA..." value="{{ $search }}">
        </div>

        <div class="col-md-3">
            <label class="form-label small fw-semibold">Destinasi</label>
            <select name="destinasi" class="form-select">
                <option value="">Semua Destinasi</option>
                @foreach($daftarDestinasi as $d)
                    <option value="{{ $d }}" {{ $destinasi === $d ? 'selected' : '' }}>{{ $d }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label small fw-semibold">Status Pembayaran</label>
            <select name="status" class="form-select">
                <option value="">Semua Status</option>
                <option value="Lunas" {{ $status === 'Lunas' ? 'selected' : '' }}>Lunas</option>
                <option value="Menunggu Pembayaran" {{ $status === 'Menunggu Pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                <option value="Menunggu Verifikasi" {{ $status === 'Menunggu Verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                <option value="Ditolak" {{ $status === 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>

        <div class="col-md-2 d-flex align-items-end gap-2">
            <button type="submit" class="btn btn-success w-100 py-2 fw-semibold">
                <i class="bi bi-filter"></i> Filter
            </button>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary py-2" title="Reset">
                <i class="bi bi-arrow-counterclockwise"></i>
            </a>
        </div>
    </form>
</div>

<!-- Ringkasan Filter -->
<div class="alert alert-light border d-flex justify-content-between align-items-center flex-wrap gap-2 py-2 px-3 rounded-3 mb-4">
    <span class="small text-muted">
        Ditemukan <strong>{{ $totalOrders }}</strong> pesanan | Total Tiket: <strong>{{ $totalTickets }}</strong> | Total Penjualan Lunas: <strong class="text-success">Rp {{ number_format($totalSales, 0, ',', '.') }}</strong>
    </span>
</div>

<!-- Tabel Pesanan -->
<div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead class="table-light">
                <tr>
                    <th>Booking Code</th>
                    <th>Nama & WA</th>
                    <th>Destinasi</th>
                    <th>Tgl Kunjungan</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Bukti</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $ord)
                    @php
                        $st = strtolower(trim($ord->payment_status));
                        $bg = 'warning';
                        if (in_array($st, ['lunas', 'paid'])) $bg = 'success';
                        elseif ($st === 'menunggu verifikasi' || !empty($ord->payment_proof)) $bg = 'info';
                        elseif (in_array($st, ['batal', 'ditolak', 'gagal'])) $bg = 'danger';
                    @endphp
                    <tr>
                        <td><strong class="font-monospace text-dark">{{ $ord->booking_code }}</strong></td>
                        <td>
                            <strong class="text-dark d-block">{{ $ord->full_name }}</strong>
                            <small class="text-muted">{{ $ord->whatsapp }}</small>
                        </td>
                        <td>{{ $ord->destination_name }}</td>
                        <td>{{ $ord->visit_date ? $ord->visit_date->format('d/m/Y') : '-' }}</td>
                        <td>{{ $ord->ticket_qty }}</td>
                        <td class="fw-bold">Rp {{ number_format($ord->total_price, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge bg-{{ $bg }}-subtle text-{{ $bg }} px-3 py-1 rounded-pill">
                                {{ $ord->payment_status }}
                            </span>
                        </td>
                        <td>
                            @if($ord->payment_proof)
                                <a href="{{ asset($ord->payment_proof) }}" target="_blank" class="badge bg-primary text-decoration-none">
                                    <i class="bi bi-image"></i> Lihat
                                </a>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.orders.show', $ord->id) }}" class="btn btn-sm btn-outline-primary" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form action="{{ route('admin.orders.destroy', $ord->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pesanan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-4 text-muted">Tidak ada data pesanan yang sesuai.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection
