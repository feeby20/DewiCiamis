@extends('layouts.pengelola')

@section('title', 'Kelola Profil & Destinasi Desa - ' . $desa->nama_desa)
@section('page_title', 'Kelola Profil & Harga Tiket Desa')

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 rounded-4 shadow-sm bg-white p-4">
            <h5 class="fw-bold text-dark mb-1">Informasi Desa & Destinasi</h5>
            <p class="text-muted small mb-4">Pengelola dapat mengubah deskripsi, jam operasional, foto destinasi, dan tarif tiket masuk desanya sendiri.</p>

            <form action="{{ route('pengelola.profil.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small text-muted">Nama Desa Wisata</label>
                        <input type="text" class="form-control bg-light" value="{{ $desa->nama_desa }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold small text-muted">Kecamatan</label>
                        <input type="text" class="form-control bg-light" value="{{ $desa->kecamatan }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold small text-muted">Destinasi Unggulan</label>
                        <input type="text" name="destinasi_unggulan" class="form-control" value="{{ old('destinasi_unggulan', $desa->destinasi_unggulan) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold small text-muted">Harga Tiket Masuk (Rp)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">Rp</span>
                            <input type="number" name="harga_tiket" class="form-control fw-bold text-success" value="{{ old('harga_tiket', $desa->harga_tiket) }}" min="0" required>
                        </div>
                        <div class="form-text small">Tarif tiket masuk per orang wisatawan.</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold small text-muted">Jam Buka / Operasional</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-clock"></i></span>
                            <input type="text" name="jam_buka" class="form-control" value="{{ old('jam_buka', $desa->jam_buka) }}" placeholder="contoh: 08:00 - 17:00 WIB" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold small text-muted">Hari Operasional</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-calendar3"></i></span>
                            <input type="text" name="hari_operasional" class="form-control" value="{{ old('hari_operasional', $desa->hari_operasional) }}" placeholder="contoh: Setiap Hari" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold small text-muted">Deskripsi Desa Wisata</label>
                        <textarea name="deskripsi" class="form-control" rows="5" required>{{ old('deskripsi', $desa->deskripsi) }}</textarea>
                        <div class="form-text small">Jelaskan daya tarik, keindahan alam, budaya, dan fasilitas yang tersedia bagi wisatawan.</div>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold small text-muted">Ganti Foto Destinasi Utama</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*">
                        <div class="form-text small">Format JPG, PNG, atau WEBP. Maksimal 2MB.</div>
                    </div>

                    <div class="col-12 pt-3">
                        <button type="submit" class="btn btn-success px-4 py-2 rounded-pill fw-semibold">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan Profil
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- PREVIEW FOTO & STATUS -->
    <div class="col-lg-4">
        <div class="card border-0 rounded-4 shadow-sm bg-white p-4">
            <h5 class="fw-bold text-dark mb-3">Foto Destinasi Saat Ini</h5>
            <div class="rounded-3 overflow-hidden mb-3 border text-center bg-light">
                @if($desa->gambar && file_exists(public_path($desa->gambar)))
                    <img src="{{ asset($desa->gambar) }}" alt="{{ $desa->nama_desa }}" class="img-fluid w-100" style="height: 220px; object-fit: cover;">
                @else
                    <div class="p-5 text-muted">
                        <i class="bi bi-image fs-1 d-block mb-2 text-secondary"></i>
                        <span>Foto destinasi belum diunggah</span>
                    </div>
                @endif
            </div>

            <ul class="list-group list-group-flush small">
                <li class="list-group-item d-flex justify-content-between px-0">
                    <span class="text-muted">Status Desa:</span>
                    <span class="badge bg-success-subtle text-success">{{ $desa->status_desa }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between px-0">
                    <span class="text-muted">Kategori Wisata:</span>
                    <strong>{{ $desa->kategori }}</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between px-0">
                    <span class="text-muted">SK Penetapan:</span>
                    <span>{{ $desa->sk_bupati ?? '-' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between px-0">
                    <span class="text-muted">Terakhir Diperbarui:</span>
                    <span>{{ $desa->updated_at ? $desa->updated_at->format('d M Y H:i') : '-' }}</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
