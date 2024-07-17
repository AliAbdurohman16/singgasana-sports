@extends('layouts.frontend.main')

@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="{{ route('/') }}">Beranda</a></li>
          <li>Halaman</li>
        </ol>
        <h2>Halaman Detail</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Facility Details Section ======= -->
    <section id="facility-details" class="facility-details">
      <div class="container">

        @foreach ($pages as $row)
        <div class="row gy-4">
            <h2 class="text-center">{{ $row->title }}</h2>

            @if ($row->images->count() > 0)
                <div class="col-lg-12">
                    <div class="facility-details-slider swiper">
                        <div class="swiper-wrapper text-center">
                            @foreach ($row->images as $image)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/page/'.$image->path) }}" class="img-single-page" alt="image-pages">
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            @endif

            @if (!request()->is('pages/privacy-policy') && !request()->is('pages/privacy-policy-for-app'))
                <div class="col-lg-12">
                    <div class="facility-description">
                        <p>{!! $row->content !!}</p>
                    </div>
                </div>
            @else
                <div class="col-lg-12">
                    <div class="facility-description">
                        <p>{!! $row->content !!}</p>
                    </div>
                </div>
            @endif

        </div>
        @endforeach

      </div>
    </section><!-- End Facility Details Section -->

</main><!-- End #main -->
@endsection
