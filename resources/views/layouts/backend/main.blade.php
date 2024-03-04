<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Favicons -->
    <?php $setting = App\Models\Setting::first(); ?>
    <link href="{{ asset('storage/setting/' . $setting->favicon) }}" rel="icon">
    <link href="{{ asset('storage/setting/' . $setting->favicon) }}" rel="apple-touch-icon">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/main/app.css" />

    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/shared/iconly.css"/>
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/extensions/@fortawesome/fontawesome-free/css/all.min.css"/>
  </head>

  <body>
    <script src="{{ asset('backend') }}/assets/js/initTheme.js"></script>
    <div id="app">

        <!-- Sidebar -->
        @include('layouts.backend.sidebar')

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                  <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <!-- Content -->
            @yield('content')

            <!-- Footer -->
            @include('layouts.backend.footer')

        </div>
    </div>
    <script src="{{ asset('backend') }}/assets/js/bootstrap.js"></script>
    <script src="{{ asset('backend') }}/assets/js/app.js"></script>
  </body>
</html>
