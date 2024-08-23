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
    <section class="gallery">

        <div class="container" data-aos="fade-up">

            <div class="row" data-aos="fade-up" data-aos-delay="200">

                @foreach ($galleries as $gallery)
                <div class="col-lg-4 entries">
                    <article class="entry">
                        <div class="entry-img">
                            <img src="{{ asset('storage/gallery/' . $gallery->thumbnail) }}" alt="thumbnail" class="img-gallery">
                        </div>

                        <h2 class="entry-title">
                            <a href="{{ route('gallery.detail', $gallery->slug) }}">{{ $gallery->title }}</a>
                        </h2>
                        <p>{{ $gallery->short_description }}</p>
                    </article><!-- End gallery entry -->
                </div>
                @endforeach

            </div>

        </div>

    </section><!-- End Gallery Section -->

</main><!-- End #main -->
@endsection
