@extends('frontend.blog.layouts.main')

@section('breadcrumbs')
<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
    <div class="container">

        <ol>
            <li><a href="{{ route('/') }}">Beranda</a></li>
            <li><a href="{{ route('blog.index') }}">Blog</a></li>
            <li>Tag Blog</li>
        </ol>
        <h2>Blog berdasarkan tag {{ $tag->name }}</h2>

    </div>
</section><!-- End Breadcrumbs -->
@endsection

@section('article')
<div class="col-lg-8 entries">

    @if(count($articles) > 0)

    @foreach ($articles as $row)
    <article class="entry">

        <div class="entry-img">
            <img src="{{ asset('storage/article/' . $row->image) }}" alt="image-blog" class="img-fluid">
        </div>

        <h2 class="entry-title">
            <a href="{{ route('blog.single', $row->slug) }}">{{ $row->title }}</a>
        </h2>

        <div class="entry-meta">
            <ul>
                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="{{ route('blog.author', $row->user_id) }}">{{ $article->user->first_name }} {{ $article->user->last_name }}</a></li>
                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="{{ route('blog.date', date('y-m-d', strtotime($row->created_at))) }}"><time datetime="{{ date('y-m-d', strtotime($row->created_at)) }}">{{ date('d-M-Y', strtotime($row->created_at)) }}</time></a></li>
                <li class="d-flex align-items-center"><i class="bi bi-folder"></i> <a href="{{ route('blog.category', $row->category->slug) }}">{{ $row->category->title }}</a></li>
            </ul>
        </div>

        <div class="entry-content">
            <p>{!! Str::limit($row->content, $limit = 700, $end = '...') !!}</p>
            <div class="read-more">
            <a href="{{ route('blog.single', $row->slug) }}">Read More</a>
            </div>
        </div>

    </article><!-- End blog entry -->
    @endforeach

    <div class="blog-pagination">
        <ul class="justify-content-center">
            @if ($articles->lastPage() > 1)
                <li class="{{ ($articles->currentPage() == 1) ? ' disabled' : '' }}">
                    <a href="{{ $articles->url(1) }}">Previous</a>
                </li>
                @for ($i = 1; $i <= $articles->lastPage(); $i++)
                    <li class="{{ ($articles->currentPage() == $i) ? ' active' : '' }}">
                        <a href="{{ $articles->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="{{ ($articles->currentPage() == $articles->lastPage()) ? ' disabled' : '' }}">
                    <a href="{{ $articles->url($articles->currentPage()+1) }}">Next</a>
                </li>
            @endif
        </ul>
    </div>

    @else
        <div class="entry-content">
            <h2 class="entry-title">Tidak ada artikel yang ditemukan.</h2>
        </div>
    @endif
</div><!-- End blog entries list -->
@endsection
