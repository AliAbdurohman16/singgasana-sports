@extends('layouts.frontend.main')

@section('css')
<link href="{{ asset('frontend') }}/assets/vendor/virtual-select/virtual-select.min.css" rel="stylesheet">
<link href="{{ asset('frontend') }}/assets/vendor/flatpickr/flatpickr.min.css" rel="stylesheet">
@endsection

@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="{{ route('/') }}">Beranda</a></li>
        </ol>
        <h2>Booking</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">

        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <h2>Booking</h2>
            </header>

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 mb-3">
                        <form action="{{ route('booking.store') }}" method="post" id="member" class="php-email-form">
                            @csrf
                            <div class="row gy-4">
                                <h4 class="text-center">Form Booking</h4>
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required>
                                </div>
                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                </div>
                                <div class="col-md-12">
                                    <select class="form-control" name="type" id="type" required>
                                        <option value="">-- Pilih Tipe --</option>
                                        <option value="Harian">Harian</option>
                                        <option value="Member">Member</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <select name="sports[]" id="sports" placeholder="Olahraga" data-search="true" data-silent-initial-value-set="true" multiple>
                                        <option value="Personal">Personal</option>
                                        <option value="Swimming Pool">Swimming Pool</option>
                                        <option value="Basket">Basket</option>
                                        <option value="Badminton">Badminton</option>
                                        <option value="Tenis">Tenis</option>
                                        <option value="Tenis Meja">Tenis Meja</option>
                                        <option value="Squash">Squash</option>
                                        <option value="Fitness">Fitness</option>
                                        <option value="Aerobic">Aerobic</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="datetime" id="datetime" placeholder="Tanggal Booking" required>
                                </div>
                                {{-- <div class="col-md-12" id="duration" hidden>
                                    <select class="form-control" name="duration" required>
                                        <option value="">-- Pilih Durasi --</option>
                                        <option value="1 Bulan">1 Bulan</option>
                                        <option value="1 Tahun">1 Tahun</option>
                                    </select>
                                </div> --}}
                                <button type="submit">Kirim</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- End Contact Section -->

</main><!-- End #main -->
@endsection

@section('script')
<script src="{{ asset('frontend') }}/assets/vendor/jquery/jquery.min.js"></script>
<script src="{{ asset('frontend') }}/assets/vendor/virtual-select/virtual-select.min.js"></script>
<script src="{{ asset('frontend') }}/assets/vendor/fullcalendar/index.global.min.js"></script>
<script src="{{ asset('frontend') }}/assets/vendor/flatpickr/flatpickr.min.js"></script>
<script>
    // $('#type').on('change', function() {;
    //     if ($('#type option:selected').val() === 'Member') {
    //         $('#duration').prop('hidden', false);
    //     } else {
    //         $('#duration').prop('hidden', true);
    //     }
    // });

    VirtualSelect.init({
        ele: '#sports',
        maxWidth: '100%',
        required: true,
    });

    document.querySelector('#sports').validate();

    flatpickr("#datetime", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        placeholder: "Tanggal Booking"
    });

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'timeGridDay',
          timeZone: 'Asia/Jakarta',
          locale: 'id',
          slotMinTime: '8:00:00',
          slotMaxTime: '24:00:00',
          events: [
            {
                title: 'Badminton',
                start: '2023-06-24 08:00:00',
                end: '2023-06-24 09:00:00',
                eventColor: 'blue',
            },
            {
                title: 'Tennis',
                start: '2023-06-24 08:00:00',
                end: '2023-06-24 09:00:00',
                eventColor: 'red',
            },
          ],
        });
        calendar.render();
    });
</script>
@endsection

