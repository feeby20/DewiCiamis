@extends('layouts.admin')

@section('title', 'Verifikasi Pembayaran - Admin DewiCiamis')
@section('page_title', 'Verifikasi Bukti Pembayaran')

@section('content')
<div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5 class="fw-bold mb-1 text-dark">Daftar Menunggu Verifikasi ({{ $orders->count() }})</h5>
            <p class="text-muted small mb-0">Pesanan yang telah mengunggah bukti pembayaran namun belum dikonfirmasi.</p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead class="table-light">
                <tr>
                    <th>Booking Code</th>
                    <th>Nama & WA</th>
                    <th>Destinasi</th>
                    <th>Total</th>
                    <th>Bukti Pembayaran</th>
                    <th>Status Saat Ini</th>
                    <th>Aksi Konfirmasi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $ord)
                    <tr>
                        <td><strong class="font-monospace text-dark">{{ $ord->booking_code }}</strong></td>
                        <td>
                            <strong class="text-dark d-block">{{ $ord->full_name }}</strong>
                            <small class="text-muted">{{ $ord->whatsapp }}</small>
                        </td>
                        <td>{{ $ord->destination_name }}</td>
                        <td class="fw-bold text-success">Rp {{ number_format($ord->total_price, 0, ',', '.') }}</td>
                        <td>
                            @if($ord->payment_proof)
                                <a href="{{ asset($ord->payment_proof) }}" target="_blank">
                                    <img src="{{ asset($ord->payment_proof) }}" class="rounded border shadow-sm" style="width: 70px; height: 70px; object-fit: cover;" alt="Bukti">
                                </a>
                            @else
                                <span class="text-muted">Tidak ada bukti</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-warning-subtle text-warning px-3 py-1 rounded-pill">
                                {{ $ord->payment_status }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <form action="{{ route('admin.orders.update_status', $ord->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="Lunas">
                                    <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 fw-bold" onclick="return confirm('Konfirmasi pesanan ini sebagai LUNAS?');">
                                        <i class="bi bi-check-lg me-1"></i> Terima (Lunas)
                                    </button>
                                </form>

                                <form action="{{ route('admin.orders.update_status', $ord->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="Ditolak">
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Tolak bukti pembayaran ini?');">
                                        <i class="bi bi-x-lg me-1"></i> Tolak
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-check-circle-fill text-success fs-1 d-block mb-2"></i>
                            <h5 class="fw-bold text-dark">Semua Bukti Telah Diverifikasi!</h5>
                            <p class="mb-0">Tidak ada pesanan yang sedang menunggu verifikasi saat ini.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
