@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_header', 'Masuk ke Akun Anda')

@section('auth_body')
    <form action="{{ route('login') }}" method="post">
        @csrf

        {{-- Email --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="Email" autofocus required>
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

        {{-- Remember Me & Submit --}}
        <div class="row">
            <div class="col-7">
                <div class="icheck-primary">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Ingat Saya</label>
                </div>
            </div>
            <div class="col-5">
                <button type="submit" class="btn btn-block btn-primary">Masuk</button>
            </div>
        </div>
    </form>
@stop

@section('auth_footer')
    <p class="mb-0 text-center">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-center">Daftar sekarang</a>
    </p>
@stop