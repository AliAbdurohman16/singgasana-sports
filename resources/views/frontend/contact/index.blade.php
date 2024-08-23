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
                                <p>{{ $setting->address1 }}</p>
                                <p>{{ $setting->address2 }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <i class="bi bi-envelope"></i>
                                <h3>Email</h3>
                                <p>{{ $setting->email }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <i class="bi bi-telephone"></i>
                                <h3>Hubungi Kami</h3>
                                <p>Telepon 1 : {{ $setting->telephone1 }} <br>Telepon 2 : {{ $setting->telephone2 }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <i class="bi bi-clock"></i>
                                <h3>Jam buka</h3>
                                <p>{{ $setting->open_hours }}</p>
                            </div>
                        </div>
                    </div>

                </div>

                <p>
                    <iframe style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15841.625519395582!2d107.5972868!3d-6.9612954!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x5309b909297374ae!2sSinggasana+Sport+%26+Recreation+Centre!5e0!3m2!1sen!2sid!4v1499333387988" width="100%" height="450" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
                </p>

            </div>

        </div>

    </section><!-- End Contact Section -->

</main><!-- End #main -->
@endsection
