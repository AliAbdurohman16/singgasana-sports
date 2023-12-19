@extends('layouts.backend.main')

@section('title', 'Dashboard')

@section('content')
<link href="{{ asset('frontend') }}/assets/vendor/flatpickr/flatpickr.min.css" rel="stylesheet">

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
        @if (!Auth::user()->hasRole('user'))
        <div class="col-12 col-lg-8">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                  <div class="card">
                    <div class="card-body px-4 py-4-5">
                      <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                          <div class="stats-icon blue mb-2">
                            <i class="bi-ticket-detailed-fill"></i>
                          </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                          <h6 class="text-muted font-semibold">Booking Harian</h6>
                          <h6 class="font-extrabold mb-0">{{ $bookingDailies }}</h6>
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
                            <i class="bi-ticket-detailed-fill"></i>
                          </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                          <h6 class="text-muted font-semibold">Booking Member</h6>
                          <h6 class="font-extrabold mb-0">{{ $bookingMembers }}</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @if (Auth::user()->hasRole('admin'))
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
                            Data Jumlah Artikel
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
                          <div class="stats-icon red mb-2">
                            <i class="fas fa-user-tie"></i>
                          </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                          <h6 class="text-muted font-semibold">Data Jumlah Petugas</h6>
                          <h6 class="font-extrabold mb-0">{{ $officers }}</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
            </div>
          </div>
          @if (Auth::user()->hasRole('admin'))
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
          @endif
        <div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5>Jadwal Booking Harian</h5>
                </div>
                <div class="card-body">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
        @else
        <h5 class="mb-3">Selamat Datang! {{ Auth::user()->first_name }} </h5>
        <div class="row">
            @foreach ($histories as $history)
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="text-muted mb-1">{{ $history->service->name }}</h6>
                        @if ($history->service_id == 1)
                        <img src="{{ asset('qr_codes/' . $history->qr) }}" class="mb-2" width="20%" alt="QR Code"><br>
                        @else
                        <h5 class="font-bold">PIN: {{ $history->pin }}</h5>
                        @endif
                        <small class="text-muted mb-0">Kedaluwarsa: {{ date('d-m-Y H:i:s', strtotime($history->expired)) }}</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
      </div>
    </section>
    <!-- Basic Tables end -->
</div>

@if (!Auth::user()->hasRole('user'))
<script src="{{ asset('frontend') }}/assets/vendor/jquery/jquery.min.js"></script>
<script src="{{ asset('frontend') }}/assets/vendor/fullcalendar/index.global.min.js"></script>
<script>
    var schedules = {!! json_encode($schedules) !!};

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'listWeek',
            timeZone: 'Asia/Jakarta',
            locale: 'id',
            slotMinTime: '00:00:00',
            slotMaxTime: '00:00:00',
            events: schedules.map(function(schedule) {
                return {
                    title: schedule.service_name,
                    start: schedule.datetime,
                    end: schedule.expired,
                    eventColor: 'blue',
                };
            }),
        });
        calendar.render();
    });
</script>
@endif
@endsection
