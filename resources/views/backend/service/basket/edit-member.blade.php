@extends('layouts.backend.main')

@section('title', 'Edit Data Basket Member')

@section('content')
<!-- CSS -->
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/pages/summernote.css"/>
<link rel="stylesheet" href="{{ asset('backend') }}/assets/extensions/summernote/summernote-lite.css"/>

<div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last mb-3">
          <h3>Edit Data</h3>
          <a href="{{ route('basket') }}" class="btn btn-warning btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('basket') }}">Layanan</a>
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
                        <form action="{{ route('basketMember.update', $member->id) }}" method="POST" class="form" data-parsley-validate>
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
                                        <label for="first-name-column">Per 2 Jam 1x Seminggu (PAGI)</label>
                                        <input type="text" name="two_hours_morning" id="two_hours_morning" class="form-control" value="{{ intval($member->two_hours_morning) }}"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Per 3 Jam 1x Seminggu (PAGI)</label>
                                        <input type="text" name="three_hours_morning" id="three_hours_morning" class="form-control" value="{{ intval($member->three_hours_morning) }}"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Per 2 Jam 1x Seminggu (SIANG)</label>
                                        <input type="text" name="two_hours_afternoon" id="two_hours_afternoon" class="form-control" value="{{ intval($member->two_hours_afternoon) }}"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Per 4 Jam 1x Seminggu (SIANG)</label>
                                        <input type="text" name="four_hours_afternoon" id="four_hours_afternoon" class="form-control" value="{{ intval($member->four_hours_afternoon) }}"/>
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
    new AutoNumeric('#two_hours_morning', {
        currencySymbol : 'Rp ',
        decimalCharacter : ',',
        digitGroupSeparator : '.',
        decimalPlaces: 0,
    });

    new AutoNumeric('#three_hours_morning', {
        currencySymbol : 'Rp ',
        decimalCharacter : ',',
        digitGroupSeparator : '.',
        decimalPlaces: 0,
    });

    new AutoNumeric('#two_hours_afternoon', {
        currencySymbol : 'Rp ',
        decimalCharacter : ',',
        digitGroupSeparator : '.',
        decimalPlaces: 0,
    });

    new AutoNumeric('#four_hours_afternoon', {
        currencySymbol : 'Rp ',
        decimalCharacter : ',',
        digitGroupSeparator : '.',
        decimalPlaces: 0,
    });
</script>
@endsection
