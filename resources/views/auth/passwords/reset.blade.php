@extends('layouts.auth.main')

@section('content')
    <div class="auth-logo">
        <a href="index.html">
            <img src="{{ asset('frontend') }}/assets/img/Logo-SSRC-cut.webp" alt="Logo">
        </a>
    </div>
    <h1 class="auth-title">Setel Ulang Kata Sandi</h1>
    <p class="auth-subtitle mb-5">
        Masuk dengan data Anda yang benar!.
    </p>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group position-relative has-icon-left mb-4">
            <input type="text" name="email" class="form-control form-control-xl @error('email')is-invalid @enderror"
                value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('Email') }}">
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
            <input type="password" name="password"
                class="form-control form-control-xl @error('password')is-invalid @enderror" placeholder="{{ __('Kata Sandi') }}">
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

        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit">
            {{ __('Setel Ulang') }}
        </button>
    </form>
    <div class="text-center mt-5 text-lg fs-4">
        <p>
          <a class="font-bold" href="{{ route('login') }}">Kembali</a>
        </p>
    </div>
@endsection

