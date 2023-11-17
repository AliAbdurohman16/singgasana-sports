@extends('layouts.backend.main')

@section('title', 'Edit Data Petugas')

@section('content')
<div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last mb-3">
          <h3>Edit Data</h3>
          <a href="{{ route('officers.index') }}" class="btn btn-warning btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('officers.index') }}">Petugas</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                Edit Data
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
                        <form action="{{ route('officers.update', $officer->id) }}" method="POST" class="form" enctype="multipart/form-data" data-parsley-validate>
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="image-column">Foto</label>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                @if ($officer->image == 'backend/assets/images/faces/2.jpg')
                                                <img src="{{ asset($officer->image) }}"
                                                alt="image" class="img-thumbnail img-preview">
                                                @else
                                                <img src="{{ asset('storage/profile/' . $officer->image) }}"
                                                    alt="image" class="img-thumbnail img-preview">
                                                @endif
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="file" name="image" id="image"
                                                    class="form-control @error('image') is-invalid @enderror"
                                                    accept="image/*" onchange="previewImg()" />
                                                @error('image')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Nama Depan</label>
                                        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name', $officer->first_name) }}" placeholder="Nama Depan" />
                                        @error('first_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Nama Belakang</label>
                                        <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $officer->last_name) }}" placeholder="Nama Belakang" />
                                        @error('last_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Email</label>
                                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $officer->email) }}" placeholder="Email" />
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">No. Telepon</label>
                                        <input type="number" name="telephone" class="form-control @error('telephone') is-invalid @enderror" value="{{ old('telephone', $officer->telephone) }}" placeholder="No. Telepon" />
                                        @error('telephone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Kata Sandi</label>
                                        <input type="text" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Kata Sandi" />
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Konfirmasi Kata Sandi</label>
                                        <input type="text" name="password_confirmation" class="form-control" placeholder="Konfirmasi Kata Sandi" />
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Role</label>
                                        <select name="role" class="form-control @error('role') is-invalid @enderror">
                                            <option value="">-- Pilih Role --</option>
                                            <option value="admin" {{ $officer->hasRole('admin') ?? old('role') == 'admin' ? 'selected' : '' }}>admin</option>
                                            <option value="cashier" {{ $officer->hasRole('cashier') ?? old('role') == 'cashier' ? 'selected' : '' }}>cashier</option>
                                        </select>
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
