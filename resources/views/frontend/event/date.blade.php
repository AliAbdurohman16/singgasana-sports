@extends('frontend.event.layouts.main')

@section('breadcrumbs')
<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
    <div class="container">

        <ol>
            <li><a href="{{ route('/') }}">Beranda</a></li>
            <li><a href="{{ route('events.index') }}">Event</a></li>
            <li>Tanggal Event</li>
        </ol>
        <h2>Event berdasarkan tanggal {{ date('d-M-Y', strtotime($date)) }}</h2>

    </div>
</section><!-- End Breadcrumbs -->
@endsection

@section('event')
<div class="col-lg-8 entries">

    @if(count($events) > 0)

    @foreach ($events as $row)
    <article class="entry">

        <div class="entry-img">
            @if ($row->images->count() > 0)
                @php
                    $image = $row->images->first();
                @endphp
                <img src="{{ asset('storage/event/' . $image->path) }}" alt="image-blog" class="img-blog-single">
            @endif
        </div>

        <h2 class="entry-title">
            <a href="{{ route('events.single', $row->slug) }}">{{ $row->title }}</a>
        </h2>

        <div class="entry-meta">
            <ul>
                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="{{ route('events.date', date('y-m-d', strtotime($row->created_at))) }}"><time datetime="{{ date('y-m-d', strtotime($row->created_at)) }}">{{ date('d-M-Y', strtotime($row->created_at)) }}</time></a></li>
                <li class="d-flex align-items-center"><i class="bi bi-folder"></i> <a href="{{ route('events.category', $row->eventCategory->slug) }}">{{ $row->eventCategory->title }}</a></li>
                <li class="d-flex align-items-center"><i class="bi bi-{{ $row->status == 'Publish' ? 'check' : 'x' }}-circle"></i><a href="#">{{ $row->status == 'Publish' ? 'Dibuka' : 'Selesai' }}</a></li>
            </ul>
        </div>

    </article><!-- End blog entry -->
    @endforeach

    <div class="blog-pagination">
        <ul class="justify-content-center">
            @if ($events->lastPage() > 1)
                <li class="{{ ($events->currentPage() == 1) ? ' disabled' : '' }}">
                    <a href="{{ $events->url(1) }}">Previous</a>
                </li>
                @for ($i = 1; $i <= $events->lastPage(); $i++)
                    <li class="{{ ($events->currentPage() == $i) ? ' active' : '' }}">
                        <a href="{{ $events->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="{{ ($events->currentPage() == $events->lastPage()) ? ' disabled' : '' }}">
                    <a href="{{ $events->url($events->currentPage()+1) }}">Next</a>
                </li>
            @endif
        </ul>
    </div>

    @else
        <div class="entry-content">
            <h2 class="entry-title">Tidak ada event yang ditemukan.</h2>
        </div>
    @endif
</div><!-- End blog entries list -->
@endsection
