@extends('layouts.auth.main')

@section('content')
    <div class="auth-logo">
        <a href="index.html">
            <img src="{{ asset('frontend') }}/assets/img/Logo-SSRC-cut.webp" alt="Logo">
        </a>
    </div>
    <h1 class="auth-title">Daftar</h1>
    <p class="auth-subtitle mb-5">
        Masukkan data Anda untuk mendaftar ke situs web kami.
    </p>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="text" name="name" class="form-control form-control-xl @error('name')is-invalid @enderror"
                value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="{{ __('Nama Lengkap') }}">
            <div class="form-control-icon">
                <i class="bi bi-people"></i>
            </div>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group position-relative has-icon-left mb-4">
            <input type="email" name="email" class="form-control form-control-xl @error('email')is-invalid @enderror"
                value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('Email') }}">
            <div class="form-control-icon">
                <i class="bi bi-envelope"></i>
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group position-relative has-icon-left mb-4">
            <input type="number" name="telephone" class="form-control form-control-xl @error('telephone')is-invalid @enderror"
                value="{{ old('telephone') }}" required autocomplete="telephone" placeholder="{{ __('No Telepon') }}">
            <div class="form-control-icon">
                <i class="bi bi-telephone"></i>
            </div>
            @error('telephone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" name="password"
                class="form-control form-control-xl @error('password')is-invalid @enderror"
                required autocomplete="password" placeholder="{{ __('Kata Sandi') }}">
            <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" name="password_confirmation"
                class="form-control form-control-xl @error('password_confirmation')is-invalid @enderror"
                required autocomplete="password_confirmation" placeholder="{{ __('Konfirmasi Kata Sandi') }}">
            <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
        </div>

        <div class="form-group position-relative has-icon-left mb-4">
            <input type="text" name="address" class="form-control form-control-xl @error('address')is-invalid @enderror"
                value="{{ old('address') }}" required autocomplete="address" placeholder="{{ __('Alamat') }}">
            <div class="form-control-icon">
                <i class="bi bi-geo-alt"></i>
            </div>
            @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit">
            {{ __('Daftar') }}
        </button>
    </form>
    <div class="text-center mt-5 text-lg fs-4">
        <p class="text-gray-600">
          Sudah punya akun?
          <a href="{{ route('login') }}" class="font-bold">Masuk</a>.
        </p>
    </div>
@endsection
