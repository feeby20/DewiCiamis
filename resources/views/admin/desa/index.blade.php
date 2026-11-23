@extends('layouts.admin')

@section('title', 'Monitoring 57 Desa Wisata')
@section('page_title', 'Monitoring & Statistik 57 Desa Wisata')

@section('content')
<!-- STATISTIK KESELURUHAN 57 DESA -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
            <span class="text-muted small fw-semibold">TOTAL DESA WISATA</span>
            <h2 class="fw-bold text-dark my-1">{{ number_format($totalDesa) }}</h2>
            <small class="text-success"><i class="bi bi-patch-check-fill me-1"></i> SK Bupati Ciamis</small>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
            <span class="text-muted small fw-semibold">TOTAL PENGUNJUNG TIKET</span>
            <h2 class="fw-bold text-primary my-1">{{ number_format($totalPengunjung) }}</h2>
            <small class="text-muted">Orang wisatawan tercatat</small>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
            <span class="text-muted small fw-semibold">TOTAL PENDAPATAN SELURUH DESA</span>
            <h2 class="fw-bold text-success my-1">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
            <small class="text-muted">Akumulasi penjualan e-tiket</small>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
            <span class="text-muted small fw-semibold">TOTAL SALDO TERSEDIA DESA</span>
            <h2 class="fw-bold text-warning my-1">Rp {{ number_format($totalSaldoTersedia, 0, ',', '.') }}</h2>
            <small class="text-muted"><a href="{{ route('admin.pencairan.index') }}" class="text-decoration-none">Rekap Pencairan &rarr;</a></small>
        </div>
    </div>
</div>

<div class="card border-0 rounded-4 shadow-sm bg-white p-4">
    <!-- FILTER & PENCARIAN -->
    <form method="GET" action="{{ route('admin.desa.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Cari nama desa / destinasi..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="kecamatan" class="form-select">
                <option value="">Semua Kecamatan</option>
                @foreach($kecamatanList as $kec)
                    <option value="{{ $kec }}" {{ request('kecamatan') == $kec ? 'selected' : '' }}>Kec. {{ $kec }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Semua Status Desa</option>
                @foreach(['Rintisan', 'Berkembang', 'Maju', 'Mandiri'] as $st)
                    <option value="{{ $st }}" {{ request('status') == $st ? 'selected' : '' }}>{{ $st }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-success rounded-pill w-100">
                <i class="bi bi-filter"></i> Filter
            </button>
            <a href="{{ route('admin.desa.index') }}" class="btn btn-outline-secondary rounded-pill">Reset</a>
        </div>
    </form>

    <!-- TABEL MONITORING 57 DESA -->
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Desa Wisata & Kecamatan</th>
                    <th>Destinasi Unggulan</th>
                    <th>Harga Tiket</th>
                    <th>Rekening Bank Desa</th>
                    <th>Saldo Tersedia</th>
                    <th>Saldo Dicairkan</th>
                    <th>Akun Pengelola</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($desaList as $index => $desa)
                <tr>
                    <td>{{ $desaList->firstItem() + $index }}</td>
                    <td>
                        <strong class="text-dark">{{ $desa->nama_desa }}</strong><br>
                        <small class="text-muted">Kec. {{ $desa->kecamatan }}</small>
                        <span class="badge bg-light text-secondary border ms-1">{{ $desa->status_desa }}</span>
                    </td>
                    <td><span class="small">{{ $desa->destinasi_unggulan }}</span></td>
                    <td class="fw-semibold text-success">Rp {{ number_format($desa->harga_tiket, 0, ',', '.') }}</td>
                    <td>
                        @if($desa->nomor_rekening)
                            <span class="small fw-semibold">{{ $desa->nama_bank }}</span><br>
                            <code class="small">{{ $desa->nomor_rekening }}</code><br>
                            <small class="text-muted">a.n {{ $desa->atas_nama_rekening }}</small>
                        @else
                            <span class="badge bg-secondary-subtle text-secondary">Belum Diinput</span>
                        @endif
                    </td>
                    <td class="fw-bold text-dark">Rp {{ number_format($desa->saldo_tersedia, 0, ',', '.') }}</td>
                    <td class="text-muted small">Rp {{ number_format($desa->saldo_dicairkan, 0, ',', '.') }}</td>
                    <td>
                        @if($desa->pengelola)
                            <span class="badge bg-success-subtle text-success mb-1">
                                <i class="bi bi-check-circle"></i> Aktif
                            </span><br>
                            <small class="text-muted"><code>{{ $desa->pengelola->username }}</code></small>
                        @else
                            <span class="badge bg-danger-subtle text-danger">Belum Dibuat</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.desa.show', $desa->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-4 text-muted">Tidak ada data desa wisata yang cocok dengan filter pencarian.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $desaList->withQueryString()->links() }}
    </div>
</div>
@endsection
