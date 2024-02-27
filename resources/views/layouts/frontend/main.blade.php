<!DOCTYPE html>
<html lang="en">
<?php $setting = App\Models\Setting::first(); ?>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ $setting->name }}</title>
    <meta name="description"
          content="Singgasana Sports and Recreation Centre Adalah sarana olah raga dan rekreasi keluarga terletak di kawasan exclusive Permukiman Singgasana Pradana – Bandung. Terdapat fasilitas olahraga dan sarana rekreasi untuk warga sekitar & masyarakat luas. Fasilitas tersebut antara lain : Lapangan Tenis Indoor, Basket Indoor, Squash, Tenis Meja, Badminton, Batting Practice, Fitness, Aerobic, Steam, Whirlpool, Jujitsu, Archery, Sport Shop, Swimming Pool, Auditorium, Function Room, dan Pool Side Cafe. "/>
    <meta name="keywords"
          content="singgasana, sports, recreation center, rekreasi, olahraga, tempat olahraga, rekreasi keluar, beladiri, bandung, jawa barat, tenis indoor, renang, basket indoor, xquash, tenis meja, badminton, batting practice, fitness, aerobic, steam, whirlpool, jujitsu, archery, sport shop, swimming pool, auditorium, function room, pool side cafe."/>
    <meta name="author" content="Singgasana Sports and Recreation Centre"/>
    <meta name="email" content="singgasanasnr@gmail.com"/>
    <meta name="website" content="http://singgasanasports-recreationcentre.com"/>
    <meta name="Version" content="v1.0.0"/>

    <!-- Favicons -->
    <link href="{{ asset('storage/setting/' . $setting->favicon) }}" rel="icon">
    <link href="{{ asset('storage/setting/' . $setting->favicon) }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('frontend') }}/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    @yield('css')

    <!-- Template Main CSS File -->
    <link href="{{ asset('frontend') }}/assets/css/style.css" rel="stylesheet">
</head>

<body>
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <a href="{{ route('/') }}" class="logo d-flex align-items-center">
            <img src="{{ asset('frontend') }}/assets/img/Logo-SSRC-cut.webp" alt="logo">
        </a>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto {{ request()->is('/') ? 'active' : '' }}" href="{{ route('/') }}">Beranda</a></li>
                <li class="dropdown"><a class="{{ request()->is('pages/tentang-kami') || request()->is('pages/singgasana-swimming-club') ||
                    request()->is('pages/aerobik-seni-bela-diri') || request()->is('gallery') ? 'active' : '' }}" href="#"><span>Profil</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a class="{{ request()->is('pages/tentang-kami') ? 'active' : '' }}" href="{{ route('pages.index', 'tentang-kami') }}">Tentang Kami</a></li>
                        <li class="dropdown"><a class="{{ request()->is('pages/singgasana-swimming-club') || request()->is('pages/aerobik-seni-bela-diri') ? 'active' : '' }}" href=""><span>Aktifitas</span> <i class="bi bi-chevron-right"></i></a>
                            <ul>
                                <li><a class="{{ request()->is('pages/singgasana-swimming-club') ? 'active' : '' }}" href="{{ route('pages.index', 'singgasana-swimming-club') }}">Singgasana Swimming Club</a></li>
                                <li><a class="{{ request()->is('pages/aerobik-seni-bela-diri') ? 'active' : '' }}" href="{{ route('pages.index', 'aerobik-seni-bela-diri') }}">Aerobik & Seni Bela Diri</a></li>
                            </ul>
                        </li>
                        <li><a class="{{ request()->is('gallery') ? 'active' : '' }}" href="{{ route('gallery.index') }}">Galeri</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a class="{{ request()->is('facilities/*') ? 'active' : '' }}" href=""><span>Fasilitas</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a class="{{ request()->is('facilities/auditorium-function-room') ? 'active' : '' }}" href="{{ route('facilities.index', 'auditorium-function-room') }}">Auditorium & Function Room</a></li>
                        <li><a class="{{ request()->is('facilities/pool-side-cafe-kantin') ? 'active' : '' }}" href="{{ route('facilities.index', 'pool-side-cafe-kantin') }}">Pool Side Café & Kantin</a></li>
                        <li><a class="{{ request()->is('facilities/proshop') ? 'active' : '' }}" href="{{ route('facilities.index', 'proshop') }}">Proshop</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a class="{{ request()->is('pages/kolam-renang') || request()->is('pages/badminton-basket') || request()->is('pages/tenis-indoor') || request()->is('pages/tenis-meja') ||
                    request()->is('pages/squash') || request()->is('pages/batting-practice') || request()->is('pages/fitness') ? 'active' : '' }}" href="#"><span>Bagian Olahraga</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a class="{{ request()->is('pages/kolam-renang') ? 'active' : '' }}" href="{{ route('pages.index', 'kolam-renang') }}">Kolam Renang</a></li>
                        <li><a class="{{ request()->is('pages/badminton-basket') ? 'active' : '' }}" href="{{ route('pages.index', 'badminton-basket') }}">Badminton & Basket</a></li>
                        <li><a class="{{ request()->is('pages/tenis-indoor') ? 'active' : '' }}" href="{{ route('pages.index', 'tenis-indoor') }}">Tenis Indoor</a></li>
                        <li><a class="{{ request()->is('pages/tenis-meja') ? 'active' : '' }}" href="{{ route('pages.index', 'tenis-meja') }}">Tenis Meja</a></li>
                        <li><a class="{{ request()->is('pages/squash') ? 'active' : '' }}" href="{{ route('pages.index', 'squash') }}">Squash</a></li>
                        <li><a class="{{ request()->is('pages/fitness') ? 'active' : '' }}" href="{{ route('pages.index', 'fitness') }}">Fitness</a></li>
                        <li><a class="{{ request()->is('pages/whirlpool-steam') ? 'active' : '' }}" href="{{ route('pages.index', 'whirlpool-steam') }}">Whirlpool & Steam</a></li>
                        <li><a class="{{ request()->is('pages/aerobik') ? 'active' : '' }}" href="{{ route('pages.index', 'aerobik') }}">Aerobik</a></li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto {{ request()->is('blog') ? 'active' : '' }}" href="{{ route('blog.index') }}">Blog</a></li>
                <li class="dropdown"><a class="{{ request()->is('booking/*') ? 'active' : '' }}" href=""><span>Booking</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a class="{{ request()->is('booking/daily') ? 'active' : '' }}" href="{{ route('booking.daily') }}">Harian</a></li>
                        <li><a class="{{ request()->is('booking/member') ? 'active' : '' }}" href="{{ route('booking.member') }}">Member</a></li>
                        <li><a class="{{ request()->is('booking/schedule') ? 'active' : '' }}" href="{{ route('booking.schedule') }}">Cek Jadwal</a></li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto {{ request()->is('contact') ? 'active' : '' }}" href="{{ route('contact.index') }}">Kontak Kami</a></li>
                @if (Auth::user())
                <li><a class="getlogin scrollto" href="{{ route('dashboard') }}">Dashboard</a></li>
                @else
                <li><a class="getlogin scrollto" href="{{ route('login') }}">Masuk</a></li>
                <li><a class="getregister scrollto" href="{{ route('register') }}">Daftar</a></li>
                @endif
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->


@yield('content')

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

    <div class="footer-top">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-info">
                    <a href="{{ route('/') }}" class="logo d-flex align-items-center">
                        <img src="{{ asset('storage/setting/' . $setting->logo) }}" alt="logo">

                    </a>
                    <?php $page = App\Models\Page::where('slug', 'tentang-kami')->first(); ?>
                    <p>{!! Str::limit($page->content, $limit = 650, $end = '...') !!}</p>
                    <div class="social-links mt-3">
                        <a href="http://twitter.com/sngsportscentre" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="http://facebook.com/SinggasanaSportsandRecreationCentre" class="facebook"><i
                                class="bi bi-facebook"></i></a>
                        <a href="http://instagram.com/singgasanasportsandrecreation" class="instagram"><i
                                class="bi bi-instagram"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Tautan</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('/') }}">Beranda</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('pages.index', 'tentang-kami') }}">Tentang
                                Kami</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('blog.index') }}">Blog</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('contact.index') }}">Kontak</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Fasilitas</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i><a
                                href="{{ route('facilities.index', 'whirlpool-steam') }}">Whirlpool & Steam</a></li>
                        <li><i class="bi bi-chevron-right"></i><a
                                href="{{ route('facilities.index', 'auditorium-function-room') }}">Auditorium & Function
                                Room</a></li>
                        <li><i class="bi bi-chevron-right"></i><a
                                href="{{ route('facilities.index', 'pool-side-cafe-kantin') }}">Pool Side Café &
                                Kantin</a></li>
                        <li><i class="bi bi-chevron-right"></i><a href="{{ route('facilities.index', 'aerobik') }}">Aerobik</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    <h4>Kontak Kami</h4>
                    <p>{{ $setting->address1 }}</p>
                    <p>{{ $setting->address2 }}</p>
                    <p><strong>Phone:</strong> <br> Telepon 1 : {{ $setting->telephone1 }} <br>Telepon 2 : {{ $setting->telephone2 }}</p>
                    <p><strong>Email:</strong> {{ $setting->email }}</p>
                </div>

            </div>
        </div>
    </div>
</footer>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{ asset('frontend') }}/assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="{{ asset('frontend') }}/assets/vendor/aos/aos.js"></script>
<script src="{{ asset('frontend') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('frontend') }}/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="{{ asset('frontend') }}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="{{ asset('frontend') }}/assets/vendor/swiper/swiper-bundle.min.js"></script>
@yield('script')

<!-- Template Main JS File -->
<script src="{{ asset('frontend') }}/assets/js/main.js"></script>


<!-- Popper JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
        crossorigin="anonymous"></script>

<!-- Using this while rendering some javascript on some page -->
<script>
    const navLinks = document.querySelectorAll('.navlink');

    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            navLinks.forEach(navLink => {
                navLink.classList.remove('active');
            });

            link.classList.add('active');
        })
    });
</script>

</body>

</html>
