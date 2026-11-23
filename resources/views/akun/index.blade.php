@extends('layouts.app')

@section('title', 'Akun Saya - DewiCiamis')

@section('content')
<div class="container page-container" style="padding-top: 130px !important;">
    <!-- Flash message -->
    @if(session('success_profil'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success_profil') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- Sidebar Profil & Ringkasan -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-center bg-white mb-4">
                <div class="mb-3 mx-auto d-flex align-items-center justify-content-center bg-success-subtle text-success rounded-circle" style="width: 80px; height: 80px; font-size: 2.2rem;">
                    <i class="bi bi-person-fill"></i>
                </div>
                <h4 class="fw-bold text-dark mb-1">{{ $user->nama }}</h4>
                <p class="text-muted small mb-3">{{ $user->email }}</p>
                <span class="badge bg-light text-secondary border px-3 py-1 rounded-pill small">
                    Terdaftar sejak {{ $user->created_at ? $user->created_at->format('M Y') : '2026' }}
                </span>
            </div>

            <!-- Kartu Statistik -->
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                <h5 class="fw-bold mb-3">Statistik Wisata</h5>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Total Pesanan</span>
                    <strong class="text-dark">{{ $totalPesanan }} kali</strong>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted">Tiket Lunas</span>
                    <strong class="text-success">{{ $totalTiket }} tiket</strong>
                </div>
                <div class="d-flex justify-content-between py-2">
                    <span class="text-muted">Menunggu Bayar</span>
                    <strong class="text-warning">{{ $menungguPembayaran }} pesanan</strong>
                </div>
            </div>
        </div>

        <!-- Form Edit Profil & Kata Sandi -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white mb-4">
                <h4 class="fw-bold text-dark mb-4">Pengaturan Akun</h4>

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control form-control-lg" value="{{ old('nama', $user->nama) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Alamat Email</label>
                            <input type="email" name="email" class="form-control form-control-lg" value="{{ old('email', $user->email) }}" required>
                        </div>
                    </div>

                    <h5 class="fw-bold text-dark mt-4 mb-3">Ubah Kata Sandi <small class="text-muted fw-normal fs-6">(Kosongkan jika tidak ingin mengubah)</small></h5>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kata Sandi Saat Ini</label>
                            <input type="password" name="current_password" class="form-control form-control-lg" placeholder="Kata sandi saat ini">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kata Sandi Baru</label>
                            <input type="password" name="new_password" class="form-control form-control-lg" placeholder="Minimal 6 karakter" minlength="6">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success px-5 py-2 rounded-pill fw-bold">
                        Simpan Perubahan
                    </button>
                </form>
            </div>

            <!-- Riwayat Pesanan Singkat -->
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">Pesanan Terakhir</h5>
                    <a href="{{ route('order.index') }}" class="text-success small fw-bold text-decoration-none">Lihat Semua</a>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Booking Code</th>
                                <th>Destinasi</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders->take(5) as $ord)
                                <tr>
                                    <td><strong class="font-monospace small">{{ $ord->booking_code }}</strong></td>
                                    <td>{{ $ord->destination_name }}</td>
                                    <td>{{ $ord->visit_date ? $ord->visit_date->format('d/m/Y') : '-' }}</td>
                                    <td>
                                        <span class="badge bg-{{ strtolower($ord->payment_status) === 'lunas' ? 'success' : 'warning' }}">
                                            {{ $ord->payment_status }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('order.payment', ['booking' => $ord->booking_code]) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-3">Belum ada pesanan tiket.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
