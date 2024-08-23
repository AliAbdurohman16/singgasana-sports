@extends('layouts.backend.main')

@section('title', 'Detail Data Artikel Blog')

@section('content')
<div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last mb-3">
          <h3>Detail Data</h3>
          <a href="{{ route('article.index') }}" class="btn btn-warning btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('article.index') }}">Artikel Blog</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                Detail Data
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>

    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
          <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="card-title">{{ $articles->title }}</h3>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="text-center">
                                <img src="{{ asset('storage/article/' . $articles->image) }}" width="60%" alt="image"class="img-thumbnail img-preview">
                                <dt class="the-icon mb-3 mt-3">
                                    <i class="fas fa-user"></i> {{ $articles->user->name }}
                                    <i class="fas fa-tag ml-4"></i> {{ $articles->category->title }}
                                </dt>
                            </div>
                            <article>
                                {!! $articles->content !!}
                            </article>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>

@endsection
