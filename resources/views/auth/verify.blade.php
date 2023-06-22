@extends('layouts.auth.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">{{ __('Verifikasi alamat email anda') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-light-success color-success">
                            <i class="bi bi-check-circle"></i> {{ __('Tautan verifikasi baru telah dikirim ke alamat email anda.') }}
                        </div>
                    @endif

                    <div class="alert alert-light-warning color-warning">
                        <i class="bi bi-exclamation-triangle"></i> {{ __('Sebelum melanjutkan, periksa email Anda untuk tautan verifikasi.') }}
                        {{ __('Jika Anda tidak menerima email') }}
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('klik di sini untuk mengirim ulang') }}</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
