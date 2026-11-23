@extends('layouts.admin')

@section('title', 'Tulis Berita Baru - Admin')
@section('page_title', 'Tulis Berita Baru')

@section('content')
<div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white" style="max-width: 900px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold text-dark mb-0">Formulir Publikasi Berita</h5>
        <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-bold">Judul Berita</label>
            <input type="text" name="judul" class="form-control form-control-lg" value="{{ old('judul') }}" placeholder="Contoh: Festival Adat Ngikis di Situ Panjalu Digelar Meriah" required>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Tanggal Publikasi</label>
                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', date('Y-m-d')) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Gambar Utama</label>
                <input type="file" name="gambar" class="form-control" accept="image/jpeg,image/png,image/jpg,image/webp">
                <small class="text-muted">Format: JPG, PNG, WEBP (Maksimal 3 MB)</small>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Ringkasan Singkat</label>
            <textarea name="ringkasan" class="form-control" rows="2" placeholder="Satu atau dua kalimat ringkasan artikel..." required>{{ old('ringkasan') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Isi Berita Lengkap</label>
            <textarea name="isi" class="form-control" rows="8" placeholder="Tuliskan berita lengkap di sini..." required>{{ old('isi') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success btn-lg px-5 rounded-pill fw-bold">
            <i class="bi bi-send-check me-2"></i> Publikasikan Berita
        </button>
    </form>
</div>
@endsection
