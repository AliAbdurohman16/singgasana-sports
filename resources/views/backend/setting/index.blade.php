@extends('layouts.backend.main')

@section('title', 'Profil')

@section('content')
<!-- CSS -->
<link rel="stylesheet" href="{{ asset('backend') }}/assets/extensions/toastify-js/src/toastify.css"/>

<div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last mb-3">
          <h3>Pengaturan</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('setting.index') }}">Pengaturan</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                Ubah Data
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>

    <!-- Basic Horizontal form layout section start -->
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('setting.store') }}" method="POST" class="form form-horizontal" enctype="multipart/form-data" data-parsley-validate>
                                @csrf
                                @foreach ($settings as $setting)
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Nama Website</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $setting->name }}" name="name">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label>Logo</label>
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <img src="{{ asset('storage/setting/' . $setting->logo) }}"
                                                    alt="image"class="img-thumbnail logo-preview">
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="file" id="logo" class="form-control @error('logo') is-invalid @enderror" name="logo" accept="image/*" onchange="previewLogo()">
                                            @error('logo')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label>Favicon</label>
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <img src="{{ asset('storage/setting/' . $setting->favicon) }}"
                                                    alt="image"class="img-thumbnail favicon-preview">
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="file" id="favicon" class="form-control @error('favicon') is-invalid @enderror" name="favicon" accept="image/*" onchange="previewFavicon()">
                                            @error('favicon')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>Pengunjung</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="visitors" class="form-control @error('visitors') is-invalid @enderror" value="{{ $setting->visitors }}" name="visitors">
                                            @error('visitors')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>Event</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="event" class="form-control @error('event') is-invalid @enderror" value="{{ $setting->event }}" name="event">
                                            @error('event')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>Tempat Fasilitas</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="venue" class="form-control @error('venue') is-invalid @enderror" value="{{ $setting->venue }}" name="venue">
                                            @error('venue')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>PPN</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <div class="input-group">
                                                <input type="number" id="ppn" class="form-control @error('ppn') is-invalid @enderror" value="{{ $setting->ppn }}" name="ppn" aria-describedby="basic-addon2">
                                                <span class="input-group-text" id="basic-addon2">%</span>
                                                @error('ppn')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label>Email</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $setting->email }}" name="email">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>Telepon 1</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="telephone1" class="form-control @error('telephone1') is-invalid @enderror" value="{{ $setting->telephone1 }}" name="telephone1">
                                            @error('telephone1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>Telepon 2</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="telephone2" class="form-control @error('telephone2') is-invalid @enderror" value="{{ $setting->telephone2 }}" name="telephone2">
                                            @error('telephone2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>Alamat 1</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <textarea id="address1" class="form-control @error('address1') is-invalid @enderror" name="address1">{{ $setting->address1 }}</textarea>
                                            @error('address1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>Alamat 2</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <textarea id="address2" class="form-control @error('address2') is-invalid @enderror" name="address2">{{ $setting->address2 }}</textarea>
                                            @error('address2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>Jam Buka</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <textarea id="open_hours" class="form-control @error('open_hours') is-invalid @enderror" name="open_hours">{{ $setting->open_hours }}</textarea>
                                            @error('open_hours')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-block btn-primary me-1 mb-1">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic Horizontal form layout section end -->

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

    function previewLogo() {
        const logo = document.querySelector('#logo');
        const logoPreview = document.querySelector('.logo-preview');
        const fileLogo = new FileReader();
        fileLogo.readAsDataURL(logo.files[0]);
        fileLogo.onload = function(e) {
            logoPreview.src = e.target.result;
        }
    }

    function previewFavicon() {
        const favicon = document.querySelector('#favicon');
        const faviconPreview = document.querySelector('.favicon-preview');
        const fileFavicon = new FileReader();
        fileFavicon.readAsDataURL(favicon.files[0]);
        fileFavicon.onload = function(e) {
            faviconPreview.src = e.target.result;
        }
    }

    function previewHero() {
        const hero = document.querySelector('#hero');
        const heroPreview = document.querySelector('.hero-preview');
        const fileHero = new FileReader();
        fileHero.readAsDataURL(hero.files[0]);
        fileHero.onload = function(e) {
            heroPreview.src = e.target.result;
        }
    }
</script>
@endsection
