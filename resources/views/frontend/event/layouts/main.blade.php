@extends('layouts.frontend.main')

@section('content')

<main id="main">

    @yield('breadcrumbs')

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row">

                @yield('event')

                <div class="col-lg-4">

                    <div class="sidebar">

                        <h3 class="sidebar-title">Pencarian</h3>
                        <div class="sidebar-item search-form">
                            <form action="{{ route('events.search') }}" method="GET">
                                <input type="text" name="keyword">
                                <button type="submit"><i class="bi bi-search"></i></button>
                            </form>
                        </div><!-- End sidebar search form-->

                        <h3 class="sidebar-title">Kategori Event</h3>
                        <div class="sidebar-item categories">
                            <ul>
                                @foreach ($categories as $row)
                                <li><a href="{{ route('events.category', $row->slug) }}">{{ $row->title }} <span>({{ count($row->event) }})</span></a></li>
                                @endforeach
                            </ul>
                        </div><!-- End sidebar categories-->

                        <h3 class="sidebar-title">Event Terpopuler</h3>
                        <div class="sidebar-item recent-posts">
                            @foreach ($popularPosts as $row)
                            <div class="post-item clearfix">
                                @if ($row->images->count() > 0)
                                @php
                                    $image = $row->images->first();
                                @endphp
                                <img src="{{ asset('storage/event/' . $image->path) }}" alt="image-event">
                                @endif
                                <h4><a href="{{ route('events.single', $row->slug) }}">{{ $row->title }}</a></h4>
                                <time datetime="{{ date('d-M-Y', strtotime($row->created_at)) }}">{{ date('d-M-Y', strtotime($row->created_at)) }}</time>
                            </div>
                            @endforeach

                        </div><!-- End sidebar popular posts-->

                        <h3 class="sidebar-title">Event Terbaru</h3>
                        <div class="sidebar-item recent-posts">
                            @foreach ($recentPosts as $row)
                            <div class="post-item clearfix">
                                @if ($row->images->count() > 0)
                                @php
                                    $image = $row->images->first();
                                @endphp
                                <img src="{{ asset('storage/event/' . $image->path) }}" alt="image-event">
                                @endif
                                <h4><a href="{{ route('events.single', $row->slug) }}">{{ $row->title }}</a></h4>
                                <time datetime="{{ date('d-M-Y', strtotime($row->created_at)) }}">{{ date('d-M-Y', strtotime($row->created_at)) }}</time>
                            </div>
                            @endforeach

                        </div><!-- End sidebar recent posts-->

                    </div><!-- End sidebar -->

                </div><!-- End blog sidebar -->

            </div>

        </div>
    </section><!-- End Blog Section -->

</main><!-- End #main -->

@endsection
