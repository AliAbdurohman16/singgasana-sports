@extends('layouts.frontend.main')

@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="{{ route('/') }}">Beranda</a></li>
          <li>Kontak</li>
        </ol>
        <h2>Kontak Kami</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">

        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <h2>Kontak</h2>
                <p>Kontak Kami</p>
            </header>

            <div class="row gy-4">

                <div class="col-lg-12">

                    <div class="row gy-4">
                        <div class="col-md-3">
                            <div class="info-box">
                                <i class="bi bi-geo-alt"></i>
                                <h3>Alamat Kami</h3>
                                <p>Bandung <br>
                                    Jawa Barat</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <i class="bi bi-envelope"></i>
                                <h3>Email</h3>
                                <p>singgasanasnr@gmail.com</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <i class="bi bi-telephone"></i>
                                <h3>Hubungi Kami</h3>
                                <p>P : +62 22 543 6458<br>F : +62 22 543 5868</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <i class="bi bi-clock"></i>
                                <h3>Jam buka</h3>
                                <p>Setiap Hari<br>06:00 - 23:00</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </section><!-- End Contact Section -->

</main><!-- End #main -->
@endsection
