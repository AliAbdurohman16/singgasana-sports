@extends('layouts.backend.main')

@section('title', 'Edit Data Badminton Harian')

@section('content')
<!-- CSS -->
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/pages/summernote.css"/>
<link rel="stylesheet" href="{{ asset('backend') }}/assets/extensions/summernote/summernote-lite.css"/>

<div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last mb-3">
          <h3>Edit Data</h3>
          <a href="{{ route('badminton') }}" class="btn btn-warning btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('badminton') }}">Layanan</a>
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
                        <form action="{{ route('badmintonDaily.update', $daily->id) }}" method="POST" class="form" data-parsley-validate>
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Layanan</label>
                                        <input type="text" class="form-control" value="{{ $daily->service->name }}" readonly/>
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Kategori</label>
                                        <input type="text" class="form-control" value="{{ $daily->category }}" readonly/>
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Jumlah Lapangan</label>
                                        <input type="number" class="form-control" name="field_counts" value="{{ $daily->service->field_counts }}"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Per jam / Lapang (PAGI)</label>
                                        <input type="text" name="morning" id="morning" class="form-control" value="{{ old('morning', intval($daily->morning)) }}"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Per jam / Lapang (SIANG)</label>
                                        <input type="text" name="afternoon" id="afternoon" class="form-control" value="{{ old('afternoon', $daily->afternoon != NULL ? intval($daily->afternoon) : '') }}"/>
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
    new AutoNumeric('#morning', {
        currencySymbol : 'Rp ',
        decimalCharacter : ',',
        digitGroupSeparator : '.',
        decimalPlaces: 0,
    });

    new AutoNumeric('#afternoon', {
        currencySymbol : 'Rp ',
        decimalCharacter : ',',
        digitGroupSeparator : '.',
        decimalPlaces: 0,
    });
</script>
@endsection
