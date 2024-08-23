<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<?php $setting = App\Models\Setting::first(); ?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $setting->name }}</title>

    <!-- Favicons -->
    <link href="{{ asset('storage/setting/' . $setting->favicon) }}" rel="icon">
    <link href="{{ asset('storage/setting/' . $setting->favicon) }}" rel="apple-touch-icon">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/main/app.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/main/app-dark.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/pages/auth.css" />
</head>

<body>
    <script scr="{{ asset('backend') }}/assets/js/initTheme.js"></script>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    @yield('content')

                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"></div>
            </div>
        </div>
    </div>
</body>

</html>
