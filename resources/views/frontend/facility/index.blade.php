@extends('layouts.frontend.main')

@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="{{ route('/') }}">Beranda</a></li>
          <li>Fasilitas</li>
        </ol>
        <h2>Fasilitas Detail</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Facility Details Section ======= -->
    <section id="facility-details" class="facility-details">
      <div class="container">

        @foreach ($facilities as $row)
        <div class="row gy-4">
          <h2 class="text-center facility-title">{{ $row->name }}</h2>

          <div class="col-lg-12">
            <div class="facility-details-slider swiper">
              <div class="swiper-wrapper text-center">

                @if ($row->images->count() > 0)
                    @foreach ($row->images as $image)
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/facility/'.$image->path) }}" class="img-single-page" alt="image-facilities">
                        </div>
                    @endforeach
                @endif

              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="col-lg-12">
            <div class="facility-description">
              <p>{!! $row->description !!}</p>
            </div>
          </div>

        </div>
        @endforeach

      </div>
    </section><!-- End Facility Details Section -->

</main><!-- End #main -->
@endsection
