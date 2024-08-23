@extends('layouts.backend.main')

@section('title', 'Detail Data Halaman CMS')

@section('content')
<div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last mb-3">
          <h3>Detail Data</h3>
          <a href="{{ route('facility.index') }}" class="btn btn-warning btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('facility.index') }}">Halaman CMS</a>
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
                    <h3 class="card-title">{{ $facilities->name }}</h3>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="text-center mb-3">
                                <img src="{{ asset('storage/facility/' . $facilities->image) }}" width="60%" alt="image"class="img-thumbnail img-preview">
                            </div>
                            <article>
                                {!! $facilities->description !!}
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
