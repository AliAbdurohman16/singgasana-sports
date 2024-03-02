@extends('layouts.frontend.main')

@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="{{ route('/') }}">Beranda</a></li>
          <li>Galeri</li>
        </ol>
        <h2>Galeri</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Gallery Section ======= -->
    <section id="fasilitas" class="gallery">

        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <h2>Venue</h2>
                <p>Lihat venue sport yang ada</p>
            </header>

            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="gallery-flters">
                        <li data-filter="*" class="filter-active">All Venue</li>
                        <li data-filter=".filter-swim">Swimming Area</li>
                        <li data-filter=".filter-tennis">Tennis Area</li>
                    </ul>
                </div>
            </div>

            <div class="row gy-4 gallery-container" data-aos="fade-up" data-aos-delay="200">

                <div class="col-lg-4 col-md-6 gallery-item filter-swim">
                    <div class="gallery-wrap">
                        <img src="{{ asset('frontend') }}/assets/img/venue/kolam-1.webp" class="img-fluid" alt="">
                        <div class="gallery-info">
                            <h4>App 1</h4>
                            <p>App</p>
                            <div class="gallery-links">
                                <a href="{{ asset('frontend') }}/assets/img/venue/kolam-1.webp"
                                   data-gallery="galleryGallery" class="portfokio-lightbox" title="App 1"><i
                                        class="bi bi-zoom-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 gallery-item filter-swim">
                    <div class="gallery-wrap">
                        <img src="{{ asset('frontend') }}/assets/img/venue/kolam-2.webp" class="img-fluid" alt="">
                        <div class="gallery-info">
                            <h4>App 1</h4>
                            <p>App</p>
                            <div class="gallery-links">
                                <a href="{{ asset('frontend') }}/assets/img/venue/kolam-2.webp"
                                   data-gallery="galleryGallery" class="portfokio-lightbox" title="App 1"><i
                                        class="bi bi-zoom-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 gallery-item filter-swim">
                    <div class="gallery-wrap">
                        <img src="{{ asset('frontend') }}/assets/img/venue/kolam-3.webp" class="img-fluid" alt="">
                        <div class="gallery-info">
                            <h4>App 1</h4>
                            <p>App</p>
                            <div class="gallery-links">
                                <a href="{{ asset('frontend') }}/assets/img/venue/kolam-3.webp"
                                   data-gallery="galleryGallery" class="portfokio-lightbox" title="App 1"><i
                                        class="bi bi-zoom-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 gallery-item filter-swim">
                    <div class="gallery-wrap">
                        <img src="{{ asset('frontend') }}/assets/img/venue/kolam-4.webp" class="img-fluid" alt="">
                        <div class="gallery-info">
                            <h4>App 1</h4>
                            <p>App</p>
                            <div class="gallery-links">
                                <a href="{{ asset('frontend') }}/assets/img/venue/kolam-4.webp"
                                   data-gallery="galleryGallery" class="portfokio-lightbox" title="App 1"><i
                                        class="bi bi-zoom-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 gallery-item filter-swim">
                    <div class="gallery-wrap">
                        <img src="{{ asset('frontend') }}/assets/img/venue/kolam-5.webp" class="img-fluid" alt="">
                        <div class="gallery-info">
                            <h4>App 1</h4>
                            <p>App</p>
                            <div class="gallery-links">
                                <a href="{{ asset('frontend') }}/assets/img/venue/kolam-5.webp"
                                   data-gallery="galleryGallery" class="portfokio-lightbox" title="App 1"><i
                                        class="bi bi-zoom-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 gallery-item filter-swim">
                    <div class="gallery-wrap">
                        <img src="{{ asset('frontend') }}/assets/img/venue/kolam-6.webp" class="img-fluid" alt="">
                        <div class="gallery-info">
                            <h4>App 1</h4>
                            <p>App</p>
                            <div class="gallery-links">
                                <a href="{{ asset('frontend') }}/assets/img/venue/kolam-6.webp"
                                   data-gallery="galleryGallery" class="portfokio-lightbox" title="App 1"><i
                                        class="bi bi-zoom-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 gallery-item filter-swim">
                    <div class="gallery-wrap">
                        <img src="{{ asset('frontend') }}/assets/img/venue/kolam-2.webp" class="img-fluid" alt="">
                        <div class="gallery-info">
                            <h4>Kolam</h4>
                            <p></p>
                            <div class="gallery-links">
                                <a href="{{ asset('frontend') }}/assets/img/venue/kolam-2.webp"
                                   data-gallery="galleryGallery" class="portfokio-lightbox" title="Web 3"><i
                                        class="bi bi-zoom-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 gallery-item filter-tennis">
                    <div class="gallery-wrap">
                        <img src="{{ asset('frontend') }}/assets/img/venue/tenis-meja-2.webp" class="img-fluid"
                             alt="">
                        <div class="gallery-info">
                            <h4>App 2</h4>
                            <p>App</p>
                            <div class="gallery-links">
                                <a href="{{ asset('frontend') }}/assets/img/venue/tenis-meja-2.webp"
                                   data-gallery="galleryGallery" class="portfokio-lightbox" title="App 2"><i
                                        class="bi bi-zoom-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 gallery-item filter-tennis">
                    <div class="gallery-wrap">
                        <img src="{{ asset('frontend') }}/assets/img/venue/tenis-meja-3.webp" class="img-fluid"
                             alt="">
                        <div class="gallery-info">
                            <h4>App 2</h4>
                            <p>App</p>
                            <div class="gallery-links">
                                <a href="{{ asset('frontend') }}/assets/img/venue/tenis-meja-3.webp"
                                   data-gallery="galleryGallery" class="portfokio-lightbox" title="App 2"><i
                                        class="bi bi-zoom-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 gallery-item filter-tennis">
                    <div class="gallery-wrap">
                        <img src="{{ asset('frontend') }}/assets/img/venue/tenis-meja-1.webp" class="img-fluid"
                             alt="">
                        <div class="gallery-info">
                            <h4>App 2</h4>
                            <p>App</p>
                            <div class="gallery-links">
                                <a href="{{ asset('frontend') }}/assets/img/venue/tenis-meja-1.webp"
                                   data-gallery="galleryGallery" class="portfokio-lightbox" title="App 2"><i
                                        class="bi bi-zoom-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section><!-- End Gallery Section -->

</main><!-- End #main -->
@endsection
