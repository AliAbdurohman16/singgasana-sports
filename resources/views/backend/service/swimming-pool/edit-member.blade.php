@extends('layouts.backend.main')

@section('title', 'Edit Data Swimming Pool Member')

@section('content')
<!-- CSS -->
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/pages/summernote.css"/>
<link rel="stylesheet" href="{{ asset('backend') }}/assets/extensions/summernote/summernote-lite.css"/>

<div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last mb-3">
          <h3>Edit Data</h3>
          <a href="{{ route('swimmingPool') }}" class="btn btn-warning btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('swimmingPool') }}">Layanan</a>
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
                        <form action="{{ route('swimmingPoolMember.update', $member->id) }}" method="POST" class="form" data-parsley-validate>
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Layanan</label>
                                        <input type="text" class="form-control" value="{{ $member->service->name }}" readonly/>
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Member</label>
                                        <input type="text" class="form-control" value="{{ $member->member }}" readonly/>
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Kategori</label>
                                        <input type="text" class="form-control" value="{{ $member->category }}" readonly/>
                                    </div>
                                    @if ($member->member == 'Personal' || $member->member == 'Couple' || $member->member == 'Triple' || $member->member == 'Family' || $member->member == 'Student'|| $member->member == 'Community' || $member->member == 'Corporate' || $member->member == 'Ikawarna')
                                        <div class="form-group">
                                            <label for="first-name-column">Iuran Membership 2 Bulan {{ $member->member == 'Community' || $member->member == 'Corporate' || $member->member == 'Ikawarna' ? '(5 Orang)' : '' }}</label>
                                            <input type="text" name="two_months" id="two_months" class="form-control" value="{{ $member->two_months != NULL ? intval($member->two_months) : '' }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name-column">Iuran Membership 6 Bulan {{ $member->member == 'Community' || $member->member == 'Corporate' || $member->member == 'Ikawarna' ? '(5 Orang)' : ''}}</label>
                                            <input type="text" name="six_months" id="six_months" class="form-control" value="{{ $member->six_months != NULL ? intval($member->six_months) : '' }}"/>
                                        </div>
                                        @if ($member->member == 'Personal' || $member->member == 'Couple' || $member->member == 'Triple' || $member->member == 'Family')
                                            <div class="form-group">
                                                <label for="first-name-column">Iuran Membership 12 Bulan</label>
                                                <input type="text" name="twelve_months" id="twelve_months" class="form-control" value="{{ $member->twelve_months != NULL ? intval($member->twelve_months) : '' }}"/>
                                            </div>
                                        @endif
                                    @endif
                                    @if ($member->member == 'Community' || $member->member == 'Corporate' || $member->member == 'Ikawarna')
                                        <div class="form-group">
                                            <label for="first-name-column">Iuran Membership 2 Bulan (10 Orang)</label>
                                            <input type="text" name="two_months_ten_people" id="two_months_ten_people" class="form-control" value="{{ $member->two_months_ten_people != NULL ? intval($member->two_months_ten_people) : '' }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name-column">Iuran Membership 6 Bulan (10 Orang)</label>
                                            <input type="text" name="six_months_ten_people" id="six_months_ten_people" class="form-control" value="{{ $member->six_months_ten_people != NULL ? intval($member->six_months_ten_people) : '' }}"/>
                                        </div>
                                    @endif
                                    @if ($member->member == 'Swimming Club')
                                        <div class="form-group">
                                            <label for="first-name-column">Paket A - Pemula</label>
                                            <input type="text" name="package_a" id="package_a" class="form-control" value="{{ $member->package_a != NULL ? intval($member->package_a) : '' }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name-column">Paket B - Prestasi Non Fitness</label>
                                            <input type="text" name="package_b" id="package_b" class="form-control" value="{{ $member->package_b != NULL ? intval($member->package_b) : '' }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name-column">Paket C - Prestasi + Fitness</label>
                                            <input type="text" name="package_c" id="package_c" class="form-control" value="{{ $member->package_c != NULL ? intval($member->package_c) : '' }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name-column">Paket D - Pra Prestasi</label>
                                            <input type="text" name="package_d" id="package_d" class="form-control" value="{{ $member->package_d != NULL ? intval($member->package_d) : '' }}"/>
                                        </div>
                                    @endif
                                    @if ($member->member == 'Pelatih Renang')
                                        <div class="form-group">
                                            <label for="first-name-column">Iuran Membership Pelatih Club 2 Bulan</label>
                                            <input type="text" name="member_coach_club_two_months" id="member_coach_club_two_months" class="form-control" value="{{ $member->member_coach_club_two_months != NULL ? intval($member->member_coach_club_two_months) : '' }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name-column">Iuran Membership Pelatih Club + Fitness 2 Bulan</label>
                                            <input type="text" name="member_coach_club_two_months_plus_fitness" id="member_coach_club_two_months_plus_fitness" class="form-control" value="{{ $member->member_coach_club_two_months_plus_fitness != NULL ? intval($member->member_coach_club_two_months_plus_fitness) : '' }}"/>
                                        </div>
                                    @endif
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
    @if ($member->member == 'Personal' || $member->member == 'Couple' || $member->member == 'Triple' || $member->member == 'Family' || $member->member == 'Student' || $member->member == 'Community' || $member->member == 'Corporate' || $member->member == 'Ikawarna')
        new AutoNumeric('#two_months', {
            currencySymbol : 'Rp ',
            decimalCharacter : ',',
            digitGroupSeparator : '.',
            decimalPlaces: 0,
        });

        new AutoNumeric('#six_months', {
            currencySymbol : 'Rp ',
            decimalCharacter : ',',
            digitGroupSeparator : '.',
            decimalPlaces: 0,
        });

        @if ($member->member == 'Personal' || $member->member == 'Couple' || $member->member == 'Triple' || $member->member == 'Family')
            new AutoNumeric('#twelve_months', {
                currencySymbol : 'Rp ',
                decimalCharacter : ',',
                digitGroupSeparator : '.',
                decimalPlaces: 0,
            });
        @endif
    @endif
    @if ($member->member == 'Community' || $member->member == 'Corporate' || $member->member == 'Ikawarna')
        new AutoNumeric('#two_months_ten_people', {
            currencySymbol : 'Rp ',
            decimalCharacter : ',',
            digitGroupSeparator : '.',
            decimalPlaces: 0,
        });

        new AutoNumeric('#six_months_ten_people', {
            currencySymbol : 'Rp ',
            decimalCharacter : ',',
            digitGroupSeparator : '.',
            decimalPlaces: 0,
        });
    @endif
    @if ($member->member == 'Swimming Club')
        new AutoNumeric('#package_a', {
            currencySymbol : 'Rp ',
            decimalCharacter : ',',
            digitGroupSeparator : '.',
            decimalPlaces: 0,
        });

        new AutoNumeric('#package_b', {
            currencySymbol : 'Rp ',
            decimalCharacter : ',',
            digitGroupSeparator : '.',
            decimalPlaces: 0,
        });

        new AutoNumeric('#package_c', {
            currencySymbol : 'Rp ',
            decimalCharacter : ',',
            digitGroupSeparator : '.',
            decimalPlaces: 0,
        });

        new AutoNumeric('#package_d', {
            currencySymbol : 'Rp ',
            decimalCharacter : ',',
            digitGroupSeparator : '.',
            decimalPlaces: 0,
        });
    @endif
    @if ($member->member == 'Pelatih Renang')
        new AutoNumeric('#member_coach_club_two_months', {
            currencySymbol : 'Rp ',
            decimalCharacter : ',',
            digitGroupSeparator : '.',
            decimalPlaces: 0,
        });

        new AutoNumeric('#member_coach_club_two_months_plus_fitness', {
            currencySymbol : 'Rp ',
            decimalCharacter : ',',
            digitGroupSeparator : '.',
            decimalPlaces: 0,
        });
    @endif
</script>
@endsection
