@extends('layouts.admin')

@section('title', 'Edit Berita - Admin')
@section('page_title', 'Edit Berita')

@section('content')
<div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white" style="max-width: 900px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold text-dark mb-0">Edit Berita</h5>
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

    <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-bold">Judul Berita</label>
            <input type="text" name="judul" class="form-control form-control-lg" value="{{ old('judul', $berita->judul) }}" required>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Tanggal Publikasi</label>
                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $berita->tanggal ? $berita->tanggal->format('Y-m-d') : date('Y-m-d')) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Ubah Gambar (Opsional)</label>
                <input type="file" name="gambar" class="form-control" accept="image/jpeg,image/png,image/jpg,image/webp">
                @if($berita->gambar)
                    <small class="text-success d-block mt-1">Gambar saat ini: {{ $berita->gambar }}</small>
                @endif
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Ringkasan Singkat</label>
            <textarea name="ringkasan" class="form-control" rows="2" required>{{ old('ringkasan', $berita->ringkasan) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Isi Berita Lengkap</label>
            <textarea name="isi" class="form-control" rows="8" required>{{ old('isi', $berita->isi) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success btn-lg px-5 rounded-pill fw-bold">
            <i class="bi bi-save me-2"></i> Simpan Perubahan
        </button>
    </form>
</div>
@endsection
