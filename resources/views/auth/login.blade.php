@extends('layouts.auth.main')

@section('content')
    <div class="auth-logo">
        <a href="index.html">
            <img src="{{ asset('frontend') }}/assets/img/Logo-SSRC-cut.webp" alt="Logo">
        </a>
    </div>
    <h1 class="auth-title">Masuk</h1>
    <p class="auth-subtitle mb-5">
        Masuk dengan data Anda yang benar!.
    </p>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group position-relative has-icon-left mb-4">
            <input type="text" name="email" class="form-control form-control-xl @error('email')is-invalid @enderror"
                value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('Email') }}">
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

        <div class="form-check form-check-lg d-flex align-items-end">
            <input class="form-check-input me-2" name="remember" type="checkbox" id="remember"
                {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label text-gray-600" for="remember"> {{ __('Ingat saya') }}
            </label>
        </div>
        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit">
            {{ __('Masuk') }}
        </button>
    </form>
    <div class="text-center mt-5 text-lg fs-4">
        <p class="text-gray-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-bold">Daftar</a>.
          </p>
        <p>
          <a class="font-bold" href="{{ route('password.request') }}">Lupa Kata Sandi?</a>
        </p>
    </div>
@endsection
