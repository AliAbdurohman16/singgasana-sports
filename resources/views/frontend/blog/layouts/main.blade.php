@extends('layouts.frontend.main')

@section('content')

<main id="main">

    @yield('breadcrumbs')

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row">

                @yield('article')

                <div class="col-lg-4">

                    <div class="sidebar">

                        <h3 class="sidebar-title">Pencarian</h3>
                        <div class="sidebar-item search-form">
                            <form action="{{ route('blog.search') }}" method="GET">
                                <input type="text" name="keyword">
                                <button type="submit"><i class="bi bi-search"></i></button>
                            </form>
                        </div><!-- End sidebar search form-->

                        <h3 class="sidebar-title">Kategori</h3>
                        <div class="sidebar-item categories">
                            <ul>
                                @foreach ($categories as $row)
                                <li><a href="{{ route('blog.category', $row->slug) }}">{{ $row->title }} <span>({{ count($row->article) }})</span></a></li>
                                @endforeach
                            </ul>
                        </div><!-- End sidebar categories-->

                        <h3 class="sidebar-title">Postingan Terbaru</h3>
                        <div class="sidebar-item recent-posts">
                            @foreach ($recentPosts as $row)
                            <div class="post-item clearfix">
                                <img src="{{ asset('storage/article/' . $row->image) }}" alt="image-blog">
                                <h4><a href="{{ route('blog.single', $row->slug) }}">{{ $row->title }}</a></h4>
                                <time datetime="{{ date('d-M-Y', strtotime($row->created_at)) }}">{{ date('d-M-Y', strtotime($row->created_at)) }}</time>
                            </div>
                            @endforeach

                        </div><!-- End sidebar recent posts-->

                        <h3 class="sidebar-title">Tag</h3>
                        <div class="sidebar-item tags">
                            <ul>
                                @foreach ($tags as $tag)
                                <li><a href="{{ route('blog.tag', $tag->slug) }}">{{ $tag->name }}</a></li>
                                @endforeach
                            </ul>
                        </div><!-- End sidebar tags-->

                    </div><!-- End sidebar -->

                </div><!-- End blog sidebar -->

            </div>

        </div>
    </section><!-- End Blog Section -->

</main><!-- End #main -->

@endsection
