@extends('layouts.backend.main')

@section('title', 'Edit Data Tenis Meja Member')

@section('content')
<!-- CSS -->
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/pages/summernote.css"/>
<link rel="stylesheet" href="{{ asset('backend') }}/assets/extensions/summernote/summernote-lite.css"/>

<div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last mb-3">
          <h3>Edit Data</h3>
          <a href="{{ route('tableTennis') }}" class="btn btn-warning btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('tableTennis') }}">Layanan</a>
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
                        <form action="{{ route('tableTennisMember.update', $member->id) }}" method="POST" class="form" data-parsley-validate>
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Layanan</label>
                                        <input type="text" class="form-control" value="{{ $member->service->name }}" readonly/>
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Kategori</label>
                                        <input type="text" class="form-control" value="{{ $member->category }}" readonly/>
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Per 2 Jam 1x Seminggu</label>
                                        <input type="text" name="two_hours" id="two_hours" class="form-control" value="{{ intval($member->two_hours) }}"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Per 3 Jam 1x Seminggu</label>
                                        <input type="text" name="three_hours" id="three_hours" class="form-control" value="{{ intval($member->three_hours) }}"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Paket Suka - Suka 10 Jam</label>
                                        <input type="text" name="ten_hours" id="ten_hours" class="form-control" value="{{ intval($member->ten_hours) }}"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Paket Suka - Suka 12 Jam</label>
                                        <input type="text" name="twelve_hours" id="twelve_hours" class="form-control" value="{{ intval($member->twelve_hours) }}"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Paket Suka - Suka 15 Jam</label>
                                        <input type="text" name="fifteen_hours" id="fifteen_hours" class="form-control" value="{{ intval($member->fifteen_hours) }}"/>
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
<script src="{{ asset('backend') }}/assets/extensions/autoNumeric/autoNumeric.min.js"></script>
<script>
    new AutoNumeric('#two_hours', {
        currencySymbol : 'Rp ',
        decimalCharacter : ',',
        digitGroupSeparator : '.',
        decimalPlaces: 0,
    });

    new AutoNumeric('#three_hours', {
        currencySymbol : 'Rp ',
        decimalCharacter : ',',
        digitGroupSeparator : '.',
        decimalPlaces: 0,
    });

    new AutoNumeric('#ten_hours', {
        currencySymbol : 'Rp ',
        decimalCharacter : ',',
        digitGroupSeparator : '.',
        decimalPlaces: 0,
    });

    new AutoNumeric('#twelve_hours', {
        currencySymbol : 'Rp ',
        decimalCharacter : ',',
        digitGroupSeparator : '.',
        decimalPlaces: 0,
    });

    new AutoNumeric('#fifteen_hours', {
        currencySymbol : 'Rp ',
        decimalCharacter : ',',
        digitGroupSeparator : '.',
        decimalPlaces: 0,
    });
</script>
@endsection
