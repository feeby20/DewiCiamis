@extends('layouts.admin')

@section('title', 'Detail Desa Wisata - ' . $desa->nama_desa)
@section('page_title', 'Detail Desa Wisata ' . $desa->nama_desa)

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.desa.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="bi bi-arrow-left"></i> Kembali ke Monitoring 57 Desa
    </a>
</div>

<div class="row g-4 mb-4">
    <!-- PROFIL DESA -->
    <div class="col-lg-8">
        <div class="card border-0 rounded-4 shadow-sm bg-white p-4 h-100">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill mb-2">Desa {{ $desa->status_desa }}</span>
                    <h3 class="fw-bold text-dark mb-0">Desa Wisata {{ $desa->nama_desa }}</h3>
                    <small class="text-muted">Kecamatan {{ $desa->kecamatan }} | SK: {{ $desa->sk_bupati ?? '-' }}</small>
                </div>
                <div class="text-end">
                    <span class="small text-muted d-block">Harga Tiket Masuk</span>
                    <span class="fs-4 fw-bold text-success">Rp {{ number_format($desa->harga_tiket, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="p-3 bg-light rounded-3 mb-3">
                <div class="fw-semibold text-dark mb-1">Destinasi Unggulan:</div>
                <div class="text-muted small">{{ $desa->destinasi_unggulan }}</div>
            </div>

            <div class="mb-3">
                <div class="fw-semibold text-dark mb-1">Deskripsi Desa Wisata:</div>
                <p class="text-muted small mb-0">{{ $desa->deskripsi }}</p>
            </div>

            <div class="row g-2 small border-top pt-3">
                <div class="col-sm-6">
                    <strong>Jam Operasional:</strong> {{ $desa->jam_buka }}
                </div>
                <div class="col-sm-6">
                    <strong>Hari Buka:</strong> {{ $desa->hari_operasional }}
                </div>
            </div>
        </div>
    </div>

    <!-- AKUN PENGELOLA & REKENING BANK -->
    <div class="col-lg-4">
        <div class="card border-0 rounded-4 shadow-sm bg-white p-4 mb-4">
            <h5 class="fw-bold text-dark mb-3">Akun Pengelola Desa</h5>
            @if($desa->pengelola)
                <ul class="list-unstyled small mb-0">
                    <li class="mb-2"><strong>Nama Pengelola:</strong><br>{{ $desa->pengelola->name }}</li>
                    <li class="mb-2"><strong>Username:</strong><br><code>{{ $desa->pengelola->username }}</code></li>
                    <li class="mb-2"><strong>Email Resmi:</strong><br>{{ $desa->pengelola->email }}</li>
                    <li class="mb-2"><strong>No. HP/WA:</strong><br>{{ $desa->pengelola->no_hp ?? '-' }}</li>
                    <li><strong>Status Akun:</strong> <span class="badge bg-success">Aktif</span></li>
                </ul>
            @else
                <div class="alert alert-warning small mb-0">Akun pengelola belum terdaftar.</div>
            @endif
        </div>

        <div class="card border-0 rounded-4 shadow-sm bg-white p-4">
            <h5 class="fw-bold text-dark mb-3">Rekening Bank Desa</h5>
            <div class="p-3 bg-light rounded-3 small">
                <div class="text-muted mb-1">Bank:</div>
                <div class="fw-bold mb-2">{{ $desa->nama_bank ?? 'Belum Diinput' }}</div>
                <div class="text-muted mb-1">No. Rekening:</div>
                <div class="fw-bold font-monospace mb-2">{{ $desa->nomor_rekening ?? '-' }}</div>
                <div class="text-muted mb-1">Atas Nama:</div>
                <div class="fw-bold">{{ $desa->atas_nama_rekening ?? '-' }}</div>
            </div>
        </div>
    </div>
</div>

<!-- RIWAYAT TRANSAKSI TIKET DESA INI -->
<div class="card border-0 rounded-4 shadow-sm bg-white p-4">
    <h5 class="fw-bold text-dark mb-3">Riwayat Transaksi Tiket Masuk (15 Terakhir)</h5>
    <div class="table-responsive">
        <table class="table table-hover align-middle small">
            <thead class="table-light">
                <tr>
                    <th>Kode Booking</th>
                    <th>Nama Wisatawan</th>
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
                    <td><code>{{ $ord->booking_code }}</code></td>
                    <td>{{ $ord->full_name }}</td>
                    <td>{{ $ord->visit_date ? $ord->visit_date->format('d/m/Y') : '-' }}</td>
                    <td>{{ $ord->ticket_qty }} Tiket</td>
                    <td class="fw-bold">Rp {{ number_format($ord->total_price, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge {{ $ord->payment_status === 'lunas' ? 'bg-success' : 'bg-warning' }}">
                            {{ ucfirst($ord->payment_status) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge {{ $ord->ticket_status === 'used' ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }}">
                            {{ $ord->ticket_status === 'used' ? 'Sudah Check-in' : 'Belum Dipakai' }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">Belum ada transaksi tiket tercatat untuk desa wisata ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
