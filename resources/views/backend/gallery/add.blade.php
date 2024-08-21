@extends('layouts.backend.main')

@section('title', 'Tambah Data Foto')

@section('content')
<!-- CSS -->
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/pages/summernote.css"/>
<link rel="stylesheet" href="{{ asset('backend') }}/assets/extensions/summernote/summernote-lite.css"/>

<div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last mb-3">
          <h3>Tambah Data</h3>
          <a href="{{ route('galleries.index') }}" class="btn btn-warning btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('galleries.index') }}">Foto</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                Tambah Data
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
                        <form action="{{ route('galleries.store') }}" method="POST"  class="form" enctype="multipart/form-data" data-parsley-validate>
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="city-column">Foto</label>
                                        <div class="row">
                                            <div class="col-md-2 mt-2 mb-2">
                                                <img src="{{ asset('backend/assets/images/logo/default.png') }}" alt="image"class="img-thumbnail img-preview">
                                            </div>
                                            <div class="col-md-10">
                                                <input type="file" name="thumbnail" id="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" accept="image/*" onchange="previewImg()"/>
                                                @error('thumbnail')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Judul</label>
                                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Judul" />
                                        @error('title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Deskripsi Singkat</label>
                                        <textarea name="short_description" class="form-control @error('short_description') is-invalid @enderror" rows="5" placeholder="Deskripsi Singkat">{{ old('short_description') }}</textarea>
                                        @error('short_description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="row">
                                                    <label for="city-column mb-2">Foto 1</label>
                                                    <div class="col-12 mb-2">
                                                        <img src="{{ asset('backend/assets/images/logo/default.png') }}" alt="image"class="img-thumbnail foto-1">
                                                    </div>
                                                    <div class="col-12 mb-2">
                                                        <input type="file" name="foto_1" id="foto_1" class="form-control @error('foto_1') is-invalid @enderror" accept="image/*" onchange="previewFoto1()"/>
                                                        @error('foto_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="city-column">Judul Foto 1</label>
                                                        <input type="text" name="title_foto_1" class="form-control @error('title_foto_1') is-invalid @enderror" value="{{ old('title_foto_1') }}" placeholder="Judul Foto 1"/>
                                                        @error('title_foto_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="row">
                                                    <label for="city-column mb-2">Foto 2</label>
                                                    <div class="col-12 mb-2">
                                                        <img src="{{ asset('backend/assets/images/logo/default.png') }}" alt="image"class="img-thumbnail foto-2">
                                                    </div>
                                                    <div class="col-12 mb-2">
                                                        <input type="file" name="foto_2" id="foto_2" class="form-control @error('foto_2') is-invalid @enderror" accept="image/*" onchange="previewFoto2()"/>
                                                        @error('foto_2')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="city-column">Judul Foto 2</label>
                                                        <input type="text" name="title_foto_2" class="form-control @error('title_foto_2') is-invalid @enderror" value="{{ old('title_foto_2') }}" placeholder="Judul Foto 2"/>
                                                        @error('title_foto_2')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="row">
                                                    <label for="city-column mb-2">Foto 3</label>
                                                    <div class="col-12 mb-2">
                                                        <img src="{{ asset('backend/assets/images/logo/default.png') }}" alt="image"class="img-thumbnail foto-3">
                                                    </div>
                                                    <div class="col-12 mb-2">
                                                        <input type="file" name="foto_3" id="foto_3" class="form-control @error('foto_3') is-invalid @enderror" accept="image/*" onchange="previewFoto3()"/>
                                                        @error('foto_3')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="city-column">Judul Foto 3</label>
                                                        <input type="text" name="title_foto_3" class="form-control @error('title_foto_3') is-invalid @enderror" value="{{ old('title_foto_3') }}" placeholder="Judul Foto 3"/>
                                                        @error('title_foto_3')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Deskripsi</label>
                                        <textarea name="description" id="summernote" class="form-control @error('description') is-invalid @enderror" placeholder="Deskripsi">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-center">
                                    <input type="submit" class="btn btn-primary me-1 mb-1 btn-block" value="Simpan">
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
<script>
    function previewImg() {
        const logo = document.querySelector('#thumbnail');
        const imgPreview = document.querySelector('.img-preview');
        const fileImg = new FileReader();
        fileImg.readAsDataURL(logo.files[0]);
        fileImg.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }

    function previewFoto1() {
        const foto1 = document.querySelector('#foto_1');
        const foto1Preview = document.querySelector('.foto-1');
        const fileFoto1 = new FileReader();
        fileFoto1.readAsDataURL(foto1.files[0]);
        fileFoto1.onload = function(e) {
            foto1Preview.src = e.target.result;
        }
    }

    function previewFoto2() {
        const foto2 = document.querySelector('#foto_2');
        const foto2Preview = document.querySelector('.foto-2');
        const fileFoto2 = new FileReader();
        fileFoto2.readAsDataURL(foto2.files[0]);
        fileFoto2.onload = function(e) {
            foto2Preview.src = e.target.result;
        }
    }

    function previewFoto3() {
        const foto3 = document.querySelector('#foto_3');
        const foto3Preview = document.querySelector('.foto-3');
        const fileFoto3 = new FileReader();
        fileFoto3.readAsDataURL(foto3.files[0]);
        fileFoto3.onload = function(e) {
            foto3Preview.src = e.target.result;
        }
    }
</script>
@endsection
