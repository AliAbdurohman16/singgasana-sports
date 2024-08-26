@extends('frontend.event.layouts.main')

@section('breadcrumbs')
<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
    <div class="container">

        <ol>
            <li><a href="{{ route('/') }}">Beranda</a></li>
            <li><a href="{{ route('events.index') }}">Event</a></li>
            <li>Detail Event</li>
        </ol>
        <h2>Detail Event</h2>

    </div>
</section><!-- End Breadcrumbs -->
@endsection

@section('event')
<div class="col-lg-8 entries">

    <article class="entry entry-single">

        <div class="entry-img">
            <div class="entry-slider swiper">
                <div class="swiper-wrapper text-center">
                @if ($event->images->count() > 0)
                    @foreach ($event->images as $image)
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/event/'.$image->path) }}" class="img-blog-single" alt="image-facilities">
                        </div>
                    @endforeach
                @endif
                </div>
                
                <div class="swiper-pagination"></div>
            </div>
        </div>

        <h2 class="entry-title">
            <a href="{{ route('events.single', $event->slug) }}">{{ $event->title }}</a>
        </h2>

        <div class="entry-meta">
            <ul>
                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="{{ route('events.date', date('y-m-d', strtotime($event->created_at))) }}"><time datetime="{{ date('d-M-Y', strtotime($event->created_at)) }}">{{ date('d-M-Y', strtotime($event->created_at)) }}</time></a></li>
                <li class="d-flex align-items-center"><i class="bi bi-folder"></i> <a href="{{ route('events.category', $event->eventCategory->slug) }}">{{ $event->eventCategory->title }}</a></li>
                <li class="d-flex align-items-center"><i class="bi bi-{{ $event->status == 'Publish' ? 'check' : 'x' }}-circle"></i><a href="#">{{ $event->status == 'Publish' ? 'Dibuka' : 'Selesai' }}</a></li>
                <li class="d-flex align-items-center"><i class="bi bi-eye"></i> <a>{{ $event->viewers }} Dilihat</a></li>
            </ul>
        </div>

        <div class="entry-content">
            <p>{!! $event->content !!}</p>
        </div>

    </article><!-- End blog entry -->

</div><!-- End blog entries list -->
@endsection
