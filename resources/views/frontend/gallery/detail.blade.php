@extends('layouts.frontend.main')

@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="{{ route('/') }}">Beranda</a></li>
          <li><a href="{{ route('gallery.index') }}">Galeri</a></li>
        </ol>
        <h2>Detail</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Gallery Details Section ======= -->
    <section class="gallery-details">
        <div class="row gy-4">
            <h2 class="gallery-title-detail">{{ $gallery->title }}</h2>
            <p>{{ $gallery->short_description }}</p>

            <div class="col-lg-12">
                <div class="gallery-detail-content">
                    <img src="{{ asset('storage/gallery/' . $gallery->thumbnail) }}" class="gallery-thumbnail mb-4" alt="thumbnail">
                    
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="{{ asset('storage/gallery/' . $gallery->foto_1) }}" class="gallery-img mb-4" alt="foto_1">
                        </div>
                        <div class="col-lg-4">
                            <img src="{{ asset('storage/gallery/' . $gallery->foto_2) }}" class="gallery-img mb-4" alt="foto_2">
                        </div>
                        <div class="col-lg-4">
                            <img src="{{ asset('storage/gallery/' . $gallery->foto_3) }}" class="gallery-img mb-4" alt="foto_3">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="gallery-description">
                    <p>{!! $gallery->description !!}</p>
                </div>
            </div>

        </div>
    </section><!-- End Gallery Details Section -->

</main><!-- End #main -->
@endsection
