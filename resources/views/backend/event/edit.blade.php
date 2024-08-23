@extends('layouts.backend.main')

@section('title', 'Ubah Event')

@section('content')
<!-- CSS -->
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/pages/summernote.css"/>
<link rel="stylesheet" href="{{ asset('backend') }}/assets/extensions/summernote/summernote-lite.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/main/tag-input.css"/>

<div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last mb-3">
          <h3>Ubah Data</h3>
          <a href="{{ route('event.index') }}" class="btn btn-warning btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('event.index') }}">@yield('title')</a>
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
                <div class="card-header">
                    <h4 class="card-title">@yield('title')</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('event.update', $event->id) }}" method="POST"  class="form" enctype="multipart/form-data" data-parsley-validate>
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <input type="hidden" name="id" value="{{ $event->id }}">
                                <div class="col-md-9 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Judul</label>
                                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ $event->title }}" placeholder="Judul" />
                                        @error('title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="last-name-column">Konten</label>
                                        <textarea name="content" id="summernote" class="form-control @error('content') is-invalid @enderror">{{ $event->content }}</textarea>
                                        @error('content')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="city-column">Foto</label>
                                        <input type="file" name="image[]" class="form-control @error('image') is-invalid @enderror" multiple>
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="first-name-column">Kategori</label>
                                        <select name="category" class="form-control @error('category') is-invalid @enderror">
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($categories as $row)
                                                <option id="categories_data" value="{{ $row->id }}"
                                                    {{ $event->event_category_id == $row->id ? 'selected' : '' }}>
                                                    {{ $row->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <input type="submit" class="btn btn-primary me-1 mb-1 btn-block" name="status" value="Publish">
                                    <input type="submit" class="btn btn-danger me-1 mb-1 btn-block" name="status" value="Draft">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" integrity="sha512-9UR1ynHntZdqHnwXKTaOm1s6V9fExqejKvg5XMawEMToW4sSw+3jtLrYfZPijvnwnnE8Uol1O9BcAskoxgec+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
