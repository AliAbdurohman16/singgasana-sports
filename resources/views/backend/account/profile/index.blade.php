@extends('layouts.backend.main')

@section('title', 'Profil')

@section('content')
<!-- CSS -->
<link rel="stylesheet" href="{{ asset('backend') }}/assets/extensions/toastify-js/src/toastify.css"/>

<div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last mb-3">
          <h3>Profil</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('profile.index') }}">Profil</a>
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

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body py-4 px-4">
                                      <div class="d-flex align-items-center">
                                        <div class="avatar avatar-xl">
                                            @if ($profile->image == 'backend/assets/images/faces/2.jpg')
                                                <img src="{{ $profile->image }}" class="img-preview" alt="avatar" />
                                            @else
                                                <img src="{{ asset('storage/profile/' . $profile->image ) }}" class="img-preview" alt="avatar">
                                            @endif
                                        </div>
                                        <div class="ms-3 name">
                                          <h5 class="font-bold">{{ $profile->name }}</h5>
                                          <h6 class="text-muted mb-2">{{ $profile->email }}</h6>
                                          <form action="{{ route('profile.destroy', $profile->id) }}" method="POST">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="btn btn-danger btn-sm">Hapus Foto</button>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                            </div>
                            <form action="{{ route('profile.store') }}" method="POST" class="form" enctype="multipart/form-data" data-parsley-validate>
                                @csrf
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="city-column">Foto</label>
                                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" onchange="previewImg()"/>
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Nama Depan</label>
                                        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ $profile->first_name }}" placeholder="Nama Depan" />
                                        @error('first_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Nama Belakang</label>
                                        <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ $profile->last_name }}" placeholder="Nama Belakang" />
                                        @error('last_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Email</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $profile->email }}" placeholder="Email" />
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">No Telepon</label>
                                        <input type="number" name="telephone" class="form-control @error('telephone') is-invalid @enderror" value="{{ $profile->telephone }}" placeholder="No Telepone" />
                                        @error('telephone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <input type="submit" class="btn btn-primary me-1 mb-1" value="Simpan">
                                </div>
                            </form>
                        </div>

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
<script src="{{ asset('backend') }}/assets/extensions/toastify-js/src/toastify.js"></script>
<script src="{{ asset('backend') }}/assets/extensions/parsleyjs/parsley.min.js"></script>
<script src="{{ asset('backend') }}/assets/js/pages/parsley.js"></script>
<script>
    @if (Session::has('message'))
        Toastify({
            text: "{{ Session::get('message') }}",
            duration: 3000,
            close: true,
            gravity: "top",
            position: "center",
            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
            progressBar: true,
        }).showToast();
    @endif

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
