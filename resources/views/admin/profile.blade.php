@extends('layouts.admin')

@section('title', 'Profil Admin')
@section('page_title', 'Profil Akun Administrator')

@section('content')
<div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white" style="max-width: 600px;">
    <h5 class="fw-bold text-dark mb-4">Pengaturan Administrator</h5>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.profile.update') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-bold">Alamat Email Admin</label>
            <input type="email" name="email" class="form-control form-control-lg" value="{{ old('email', $admin->email) }}" required>
        </div>

        <h6 class="fw-bold text-dark mt-4 mb-3">Ubah Kata Sandi Admin <small class="text-muted fw-normal fs-6">(Kosongkan jika tidak diubah)</small></h6>

        <div class="mb-3">
            <label class="form-label fw-semibold small">Kata Sandi Saat Ini</label>
            <input type="password" name="current_password" class="form-control form-control-lg" placeholder="Masukkan kata sandi saat ini">
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold small">Kata Sandi Baru</label>
            <input type="password" name="new_password" class="form-control form-control-lg" placeholder="Minimal 6 karakter" minlength="6">
        </div>

        <button type="submit" class="btn btn-success px-4 py-2 rounded-pill fw-bold">
            <i class="bi bi-save me-1"></i> Simpan Perubahan Profil
        </button>
    </form>
</div>
@endsection
