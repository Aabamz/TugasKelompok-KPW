@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@section('auth_header', 'Daftar Akun Baru')

@section('auth_body')
    <form action="{{ route('register') }}" method="post">
        @csrf

        {{-- Nama Lengkap --}}
        <div class="input-group mb-3">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}" placeholder="Nama Lengkap" autofocus required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Email --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="Email" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Password --}}
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="Password" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Konfirmasi Password --}}
        <div class="input-group mb-3">
            <input type="password" name="password_confirmation" class="form-control"
                   placeholder="Ulangi Password" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>

        {{-- Field ini hanya muncul kalau buka /register?akses=khusus, tidak terlihat di form normal --}}
        @if(request('akses') === 'khusus')
        <div class="input-group mb-3">
            <input type="text" name="admin_code" class="form-control @error('admin_code') is-invalid @enderror"
                   value="{{ old('admin_code') }}" placeholder="Kode Registrasi Khusus">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-key"></span>
                </div>
            </div>
            @error('admin_code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        @endif

        {{-- Tombol Register --}}
        <div class="row mb-3">
            <div class="col-12">
                <button type="submit" class="btn btn-block btn-primary">Daftar</button>
            </div>
        </div>
    </form>
@stop

@section('auth_footer')
    <p class="mb-0 text-center">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-center">Masuk di sini</a>
    </p>
@stop