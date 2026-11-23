@extends('layouts.pengelola')

@section('title', 'Rekening Bank Desa - ' . $desa->nama_desa)
@section('page_title', 'Nomor Rekening Bank Desa')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card border-0 rounded-4 shadow-sm bg-white p-4 p-md-5">
            <div class="text-center mb-4">
                <div class="bg-success-subtle text-success d-inline-flex p-3 rounded-circle mb-3">
                    <i class="bi bi-bank fs-2"></i>
                </div>
                <h4 class="fw-bold text-dark">Rekening Kas Desa / BUMDes</h4>
                <p class="text-muted small">Rekening ini digunakan sebagai tujuan pencairan dana hasil penjualan tiket wisata oleh Admin Dinas Pariwisata Ciamis.</p>
            </div>

            <form action="{{ route('pengelola.rekening.update') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold small text-muted">Nama Bank</label>
                    <select name="nama_bank" class="form-select" required>
                        <option value="">-- Pilih Bank --</option>
                        @foreach(['Bank BJB', 'Bank BRI', 'Bank Mandiri', 'Bank BCA', 'Bank BNI', 'Bank Syariah Indonesia (BSI)', 'Bank Lainnya'] as $bank)
                            <option value="{{ $bank }}" {{ old('nama_bank', $desa->nama_bank) == $bank ? 'selected' : '' }}>{{ $bank }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small text-muted">Nomor Rekening Bank</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-credit-card-2-front"></i></span>
                        <input type="text" name="nomor_rekening" class="form-control font-monospace fw-bold" value="{{ old('nomor_rekening', $desa->nomor_rekening) }}" placeholder="Contoh: 001234567890" required>
                    </div>
                    <div class="form-text small">Pastikan nomor rekening aktif dan sesuai dengan buku tabungan kas desa / BUMDes.</div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold small text-muted">Atas Nama Rekening</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                        <input type="text" name="atas_nama_rekening" class="form-control" value="{{ old('atas_nama_rekening', $desa->atas_nama_rekening) }}" placeholder="Contoh: BUMDes {{ $desa->nama_desa }} Sejahtera" required>
                    </div>
                </div>

                <div class="alert alert-warning rounded-3 small mb-4">
                    <i class="bi bi-shield-exclamation me-1"></i>
                    <strong>Perhatian:</strong> Pastikan rekening atas nama lembaga resmi desa wisata, BUMDes, atau Pokdarwis untuk kelancaran administrasi pencairan dana dari Dinas Pariwisata.
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success py-2 rounded-pill fw-semibold">
                        <i class="bi bi-save me-1"></i> Simpan Rekening Bank Desa
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
