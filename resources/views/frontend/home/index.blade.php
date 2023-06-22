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
                            <a href="#pricing"
                               class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                                <span>Get Started</span>
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

        <!-- ======= Pricing Section ======= -->
        <section id="members" class="pricing">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Keanggotaan</h2>
                    <p>Ada dua jenis keanggotaan yang kami tawarkan yaitu Personal dan Member.</p>
                </header>
                <div class="row gy-4" data-aos="fade-left">
                    <div class="col-lg-6 col-md-6" data-aos="zoom-in" data-aos-delay="100" style="display: flex; justify-content: center; align-items: center;">
                        <div class="box">
                            <h3 style="color: #07d5c0;">Personal</h3>
                            <img src="{{ asset('frontend') }}/assets/img/pricing/personal.webp" class="img-fluid" alt="membership">
                            <a href="" class="btn-buy">Pilih Sekarang</a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                        <div class="box">
                            <h3 style="color: #ff901c;">Member</h3>
                            <img src="{{ asset('frontend') }}/assets/img/pricing/triple.webp" class="img-fluid" alt="membership">
                            <a href="" class="btn-buy">Pilih Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Pricing Section -->

        <!-- ======= Recent Blog Posts Section ======= -->
        <section id="blog" class="recent-blog-posts">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Blog</h2>
                    <p>Postingan Terbaru</p>
                </header>

                <div class="row">
                    @foreach ($recentPosts as $row)
                        <div class="col-lg-4">
                            <div class="post-box">
                                <div class="post-img">
                                    <img src="{{ asset('storage/article/' . $row->image) }}" class="img-fluid"
                                         alt="image-blog">
                                </div>
                                <span class="post-date"><i class="bi bi-clock"></i> {{ date('d-M-Y', strtotime($row->created_at)) }}</span>
                                <h3 class="post-title">{{ $row->title }}</h3>
                                <a href="{{ route('blog.single', $row->slug) }}"
                                   class="readmore stretched-link mt-auto"><span>Read More</span><i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>

        </section><!-- End Recent Blog Posts Section -->

    </main><!-- End #main -->
@endsection
