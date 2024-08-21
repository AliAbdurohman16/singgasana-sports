@extends('layouts.backend.main')

@section('title', 'Ubah Data Halaman CMS')

@section('content')
<!-- CSS -->
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/pages/summernote.css"/>
<link rel="stylesheet" href="{{ asset('backend') }}/assets/extensions/summernote/summernote-lite.css"/>
<link rel="stylesheet" href="{{ asset('backend') }}/assets/extensions/filepond/filepond.css" />

<div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last mb-3">
          <h3>Ubah Data</h3>
          <a href="{{ route('facility.index') }}" class="btn btn-warning btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('facility.index') }}">Halaman CMS</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                Ubah Data
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
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('facility.update', $facility->id) }}" method="POST"  class="form" enctype="multipart/form-data" data-parsley-validate>
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <input type="hidden" name="id" value="{{ $facility->id }}">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Nama</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $facility->name }}" placeholder="Nama" readonly>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="city-column">Foto</label>
                                        <input type="file" name="image[]" class="form-control @error('image') is-invalid @enderror" multiple>
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="last-name-column">Deskripsi</label>
                                        <textarea name="description" id="summernote" class="form-control @error('description') is-invalid @enderror">{{ $facility->description }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-center">
                                    <input type="submit" class="btn btn-primary me-1 mb-1 btn-block" value="Publish">
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>

<!-- JS -->
<script src="{{ asset('backend') }}/assets/extensions/jquery/jquery.min.js"></script>
<script src="{{ asset('backend') }}/assets/extensions/summernote/summernote-lite.min.js"></script>
<script src="{{ asset('backend') }}/assets/js/pages/summernote.js"></script>
<script src="{{ asset('backend') }}/assets/extensions/parsleyjs/parsley.min.js"></script>
<script src="{{ asset('backend') }}/assets/js/pages/parsley.js"></script>
<script src="{{ asset('backend') }}/assets/extensions/filepond/filepond.js"></script>
<script src="{{ asset('backend') }}/assets/js/pages/filepond.js"></script>
@endsection
