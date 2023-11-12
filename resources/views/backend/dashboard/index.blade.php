@extends('layouts.backend.main')

@section('title', 'Dashboard')

@section('content')
<div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last mb-3">
          <h3>Dashboard</h3>
        </div>
      </div>
    </div>

    <!-- Basic Tables start -->
    <section class="section mt-5">
      <div class="row">
        <div class="col-12 col-lg-8">
            <div class="row">
              <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                  <div class="card-body px-4 py-4-5">
                    <div class="row">
                      <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                        <div class="stats-icon purple mb-2">
                            <i class="iconly-boldEdit"></i>
                        </div>
                      </div>
                      <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                        <h6 class="text-muted font-semibold">
                          Artikel
                        </h6>
                        <h6 class="font-extrabold mb-0">{{ $articles }}</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                  <div class="card-body px-4 py-4-5">
                    <div class="row">
                      <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                        <div class="stats-icon blue mb-2">
                          <i class="iconly-boldCategory"></i>
                        </div>
                      </div>
                      <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                        <h6 class="text-muted font-semibold">Kategori</h6>
                        <h6 class="font-extrabold mb-0">{{ $categories }}</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                  <div class="card-body px-4 py-4-5">
                    <div class="row">
                      <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                        <div class="stats-icon green mb-2">
                          <i class="iconly-boldPaper"></i>
                        </div>
                      </div>
                      <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                        <h6 class="text-muted font-semibold">Halaman</h6>
                        <h6 class="font-extrabold mb-0">{{ $pages }}</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                  <div class="card-body px-4 py-4-5">
                    <div class="row">
                      <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                        <div class="stats-icon red mb-2">
                          <i class="iconly-boldShield-Done"></i>
                        </div>
                      </div>
                      <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                        <h6 class="text-muted font-semibold">Fasilitas</h6>
                        <h6 class="font-extrabold mb-0">{{ $facilities }}</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-4">
            <div class="card">
              <div class="card-body py-4 px-4">
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-xl">
                    @if ($profile->image == 'backend/assets/images/faces/2.jpg')
                        <img src="{{ $profile->image }}" alt="avatar" />
                    @else
                        <img src="{{ asset('storage/profile/' . $profile->image ) }}" alt="avatar">
                    @endif
                  </div>
                  <div class="ms-3 name">
                    <h5 class="font-bold">{{ $profile->first_name }}</h5>
                    <h6 class="text-muted mb-0">{{ $profile->email }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </section>
    <!-- Basic Tables end -->
</div>

<script src="{{ asset('backend') }}/assets/extensions/apexcharts/apexcharts.min.js"></script>
<script src="{{ asset('backend') }}/assets/js/pages/dashboard.js"></script>
@endsection
