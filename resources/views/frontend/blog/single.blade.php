@extends('frontend.blog.layouts.main')

@section('breadcrumbs')
<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
    <div class="container">

        <ol>
            <li><a href="{{ route('/') }}">Beranda</a></li>
            <li><a href="{{ route('blog.index') }}">Blog</a></li>
            <li>Detail Blog</li>
        </ol>
        <h2>Detail Blog</h2>

    </div>
</section><!-- End Breadcrumbs -->
@endsection

@section('article')
<div class="col-lg-8 entries">

    <article class="entry entry-single">

        <div class="entry-img">
            <img src="{{ asset('storage/article/' . $article->image) }}" alt="image-blog" class="img-fluid">
        </div>

        <h2 class="entry-title">
            <a href="{{ route('blog.single', $article->slug) }}">{{ $article->title }}</a>
        </h2>

        <div class="entry-meta">
            <ul>
                <li class="d-flex align-items-center"><i class="bi bi-person"></i>
                    @php $userId = Crypt::encrypt($article->user_id); @endphp
                    <a href="{{ route('blog.author', $userId) }}">{{ $article->user->first_name }} {{ $article->user->last_name }}</a>
                </li>
                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="{{ route('blog.date', date('y-m-d', strtotime($article->created_at))) }}"><time datetime="{{ date('d-M-Y', strtotime($article->created_at)) }}">{{ date('d-M-Y', strtotime($article->created_at)) }}</time></a></li>
                <li class="d-flex align-items-center"><i class="bi bi-folder"></i> <a href="{{ route('blog.category', $article->category->slug) }}">{{ $article->category->title }}</a></li>
                <li class="d-flex align-items-center"><i class="bi bi-eye"></i> <a>{{ $article->viewers }} Dilihat</a></li>
            </ul>
        </div>

        <div class="entry-content">
            <p>{!! $article->content !!}</p>
        </div>

        <div class="entry-footer">
            <i class="bi bi-tags"></i>
            <ul class="tags">
                @foreach ($article->tags as $tag)
                    <li><a href="">{{ $tag->name }}</a></li>
                @endforeach
            </ul>
          </div>

    </article><!-- End blog entry -->

</div><!-- End blog entries list -->
@endsection
