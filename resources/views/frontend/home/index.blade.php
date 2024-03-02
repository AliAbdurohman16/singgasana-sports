@extends('layouts.frontend.main')

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="beranda" class="hero d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">{{ $setting->name }}</h1>
                    <h2 data-aos="fade-up" data-aos-delay="400">{{ $setting->slogan }}</h2>
                    <div data-aos="fade-up" data-aos-delay="600">
                        <div class="text-center text-lg-start">
                            <a href="#booking"
                               class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                                <span>Join Sekarang</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                    <img src="{{ asset('storage/setting/' . $setting->hero) }}" class="img-fluid" alt="hero">
                </div>
            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">
        <!-- ======= About Section ======= -->
        <section id="tentang" class="about">

            <div class="container" data-aos="fade-up">
                <div class="row gx-0">

                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up"
                         data-aos-delay="200">
                        <div class="content">
                            <h3>Tentang Kami</h3>
                            <h2>{{ $setting->name }}</h2>
                            <p>
                                {!! Str::limit($page->content, $limit = 650, $end = '...') !!}
                            </p>
                            <div class="text-center text-lg-start">
                                <a href="{{ route('pages.index', 'tentang-kami') }}"
                                   class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                                    <span>Baca Selengkapnya</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                        @if ($page->images->count() > 0)
                            @foreach ($page->images as $image)
                                <img src="{{ asset('storage/page/' . $image->path) }}" class="img-fluid"
                                     alt="img-about">
                            @endforeach
                        @endif
                    </div>

                </div>
            </div>

        </section><!-- End About Section -->

        <!-- ======= Counts Section ======= -->
        <section id="counts" class="counts">
            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Statistik</h2>
                    <p>Berapa banyak angka yang kami peroleh</p>
                </header>

                <div class="row gy-4 justify-content-center">

                    <div class="col-lg-3 col-md-6">
                        <div class="count-box">
                            <i class="bi bi-emoji-smile"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="232"
                                      data-purecounter-duration="1" class="purecounter"></span>
                                <p>Pengunjung</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="count-box">
                            <i class="bi bi-journal-richtext" style="color: #ee6c20;"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="521"
                                      data-purecounter-duration="1" class="purecounter"></span>
                                <p>Event</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="count-box">
                            <i class="bi bi-pin-map-fill" style="color: #15be56;"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="1463"
                                      data-purecounter-duration="1" class="purecounter"></span>
                                <p>Tempat Fasilitas</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Counts Section -->

        <!-- ======= Features Section ======= -->
        <section id="features" class="features">
            <div class="container" data-aos="fade-up">
                <header class="section-header">
                    <h2>Fasilitas</h2>
                    <p>Beberapa fasilitas yang tersedia di kami.</p>
                </header>

                <div class="row">
                    <div class="col-lg-6">
                        <img src="{{ asset('frontend') }}/assets/img/values-3.png" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-6 mt-5 mt-lg-0 d-flex">
                        <div class="row align-self-center gy-4">

                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="200">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>Whirlpool & Steam</h3>
                            </div>
                            </div>

                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="300">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>Auditorium & Function Room</h3>
                            </div>
                            </div>

                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="400">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>Pool Side Café & Kantin</h3>
                            </div>
                            </div>

                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="500">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>Aerobik</h3>
                            </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- / row -->
            </div>
        </section>

        <!-- ======= Pricing Section ======= -->
        <section id="booking" class="pricing">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Booking</h2>
                    <p>Ada dua jenis keanggotaan yang kami tawarkan yaitu Harian dan Member.</p>
                </header>
                <div class="row gy-4" data-aos="fade-left">
                    <div class="col-lg-6 col-md-6" data-aos="zoom-in" data-aos-delay="100" style="display: flex; justify-content: center; align-items: center;">
                        <div class="box">
                            <h3 style="color: #07d5c0;">Harian</h3>
                            <img src="{{ asset('frontend') }}/assets/img/pricing/personal.webp" class="img-fluid" alt="membership">
                            <a href="{{ route('booking.daily') }}" class="btn-buy">Pilih Sekarang</a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                        <div class="box">
                            <h3 style="color: #ff901c;">Member</h3>
                            <img src="{{ asset('frontend') }}/assets/img/pricing/triple.webp" class="img-fluid" alt="membership">
                            <a href="{{ route('booking.member') }}" class="btn-buy">Pilih Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Pricing Section -->

        <!-- ======= Recent Blog Posts Section ======= -->
        <section id="blog" class="blog">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Blog</h2>
                    <p>Postingan Terbaru</p>
                </header>

                <div class="row">
                    @foreach ($recentPosts as $row)
                        <div class="col-lg-4 entries">
                            <article class="entry">

                                <div class="entry-img">
                                    <img src="{{ asset('storage/article/' . $row->image) }}" alt="image-blog" class="img-fluid">
                                </div>

                                <h2 class="entry-title">
                                    <a href="{{ route('blog.single', $row->slug) }}">{{ $row->title }}</a>
                                </h2>

                                <div class="entry-meta">
                                    <ul>
                                        <li class="d-flex align-items-center"><i class="bi bi-person"></i>
                                            @php $userId = Crypt::encrypt($row->user_id); @endphp
                                            <a href="{{ route('blog.author', $userId) }}">{{ $row->user->first_name }} {{ $row->user->last_name }}</a>
                                        </li>
                                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="{{ route('blog.date', date('y-m-d', strtotime($row->created_at))) }}"><time datetime="{{ date('y-m-d', strtotime($row->created_at)) }}">{{ date('d-M-Y', strtotime($row->created_at)) }}</time></a></li>
                                        <li class="d-flex align-items-center"><i class="bi bi-folder"></i> <a href="{{ route('blog.category', $row->category->slug) }}">{{ $row->category->title }}</a></li>
                                    </ul>
                                </div>

                            </article><!-- End blog entry -->
                        </div>
                    @endforeach
                </div>

            </div>

        </section><!-- End Recent Blog Posts Section -->

    </main><!-- End #main -->
@endsection
