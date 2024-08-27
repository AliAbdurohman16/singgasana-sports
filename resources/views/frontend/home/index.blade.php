@extends('layouts.frontend.main')

@section('content')
    <!-- ======= Hero ======= -->
    <div class="hero">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($banners as $banner)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <a href="{{ $banner->link }}" target="_blank">
                        <img src="{{ asset('storage/banner/' . $banner->image) }}" class="d-block carousel-img w-100" alt="banner">
                    </a>
                </div>
                @endforeach
            </div>

            @if ($banners->count() > 1)
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            @endif
        </div>
    </div>

    <main id="main">
        <!-- ======= About Section ======= -->
        <section id="tentang" class="about">

            <div class="container" data-aos="fade-up">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-md-6 col-12">
                        @if ($page->images->count() > 0)
                            @foreach ($page->images as $image)
                                <img src="{{ asset('storage/page/' . $image->path) }}" class="img-fluid"
                                    alt="img-about">
                            @endforeach
                        @endif
                    </div><!--end col-->

                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up"
                         data-aos-delay="200">
                        <div class="content">
                            <h3>Tentang Kami</h3>
                            <h2>{{ $setting->name }}</h2>
                            {!! Str::limit($page->content, $limit = 650, $end = '...') !!}
                            <div class="text-center text-lg-start mt-5">
                                <a href="{{ route('pages.index', 'tentang-kami') }}"
                                   class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                                    <span>Baca Selengkapnya</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                </div><!--end row-->
            </div><!--end container-->

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
                                <span data-purecounter-start="0" data-purecounter-end="{{ $setting->visitors }}"
                                      data-purecounter-duration="1" class="purecounter"></span>
                                <p>Pengunjung</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="count-box">
                            <i class="bi bi-journal-richtext" style="color: #ee6c20;"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="{{ $setting->event }}"
                                      data-purecounter-duration="1" class="purecounter"></span>
                                <p>Event</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="count-box">
                            <i class="bi bi-pin-map-fill" style="color: #15be56;"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="{{ $setting->venue }}"
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
                                <h3>Proshop</h3>
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
                            <article class="entry"  style="height: 530px">

                                <div class="entry-img">
                                    <img src="{{ asset('storage/article/' . $row->image) }}" alt="image-blog" class="img-blog">
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