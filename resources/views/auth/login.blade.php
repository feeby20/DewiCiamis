@extends('layouts.app')

@section('title', 'Masuk - DewiCiamis')

@section('content')
<div class="container page-container" style="padding-top: 130px !important; max-width: 460px;">
    <div class="card border-0 shadow rounded-4 p-4 p-md-5 bg-white">
        <div class="text-center mb-4">
            <img src="{{ asset('pictures/LogoDispar.png') }}" alt="Logo Dispar Ciamis" class="login-modal-logo mb-3" style="width: 72px;">
            <h3 class="login-modal-title fw-bold">Masuk ke Akun</h3>
            <p class="text-muted small">Silakan masukkan email dan kata sandi Anda</p>
        </div>

        @if(session('login_error'))
            <div class="alert alert-danger" role="alert">
                {{ session('login_error') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control form-control-lg" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn btn-login btn-lg w-100 fw-bold mb-3">Masuk</button>
        </form>

        <p class="text-center mt-3 mb-0 small text-muted">
            Belum punya akun?
            <a href="#" class="text-success fw-bold text-decoration-none" data-bs-toggle="modal" data-bs-target="#registerModal">Daftar sekarang</a>
        </p>
    </div>
</div>
@endsection
