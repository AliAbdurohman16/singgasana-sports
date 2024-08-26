@extends('layouts.backend.main')

@section('title', 'Ubah Data Foto')

@section('content')

<div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last mb-3">
          <h3>Ubah Data</h3>
          <a href="{{ route('banners.index') }}" class="btn btn-warning btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('banners.index') }}">Foto</a>
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
          <div class="col-lg-6">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('banners.update', $banner->id) }}" method="POST"  class="form" enctype="multipart/form-data" data-parsley-validate>
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <input type="hidden" name="id" value="{{ $banner->id }}">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="city-column">Foto</label>
                                        <div class="row">
                                            <div class="col-12 mb-2">
                                                @if ($banner->image)
                                                    <img src="{{ asset('storage/banner/' . $banner->image) }}"
                                                        alt="image"class="img-thumbnail img-preview">
                                                @else
                                                    <img src="{{ asset('backend/assets/images/logo/default.png') }}"
                                                        alt="image"class="img-thumbnail img-preview">
                                                @endif
                                            </div>
                                            <div class="col-12">
                                                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" onchange="previewImg()"/>
                                                @error('image')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Link</label>
                                        <input type="text" name="link" class="form-control" value="{{ $banner->link }}" placeholder="https://www.exmple.com" />
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
<script>
    function previewImg() {
      const logo = document.querySelector('#image');
      const imgPreview = document.querySelector('.img-preview');
      const fileImg = new FileReader();
      fileImg.readAsDataURL(logo.files[0]);
      fileImg.onload = function(e) {
        imgPreview.src = e.target.result;
      }
    }
</script>
@endsection
