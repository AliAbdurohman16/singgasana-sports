@extends('layouts.frontend.main')

@section('css')
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
                    <div class="col-lg-12">
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
<script src="{{ asset('frontend') }}/assets/vendor/fullcalendar/index.global.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'listWeek',
          timeZone: 'Asia/Jakarta',
          locale: 'id',
          slotMinTime: '8:00:00',
          slotMaxTime: '24:00:00',
          events: [
            {
                title: 'Badminton',
                start: '2023-11-11 08:00:00',
                end: '2023-11-11 09:00:00',
                eventColor: 'blue',
            },
            {
                title: 'Tennis',
                start: '2023-11-11 08:00:00',
                end: '2023-11-11 09:00:00',
                eventColor: 'red',
            },
            {
                title: 'Tennis',
                start: '2023-11-11 08:00:00',
                end: '2023-11-11 09:00:00',
                eventColor: 'red',
            },
            {
                title: 'Tennis',
                start: '2023-11-11 08:00:00',
                end: '2023-11-11 09:00:00',
                eventColor: 'red',
            },
            {
                title: 'Tennis',
                start: '2023-11-11 08:00:00',
                end: '2023-11-11 09:00:00',
                eventColor: 'red',
            },
            {
                title: 'Tennis',
                start: '2023-11-11 08:00:00',
                end: '2023-11-11 09:00:00',
                eventColor: 'red',
            },
            {
                title: 'Tennis',
                start: '2023-11-11 08:00:00',
                end: '2023-11-11 09:00:00',
                eventColor: 'red',
            },
            {
                title: 'Tennis',
                start: '2023-11-11 08:00:00',
                end: '2023-11-11 09:00:00',
                eventColor: 'red',
            },
            {
                title: 'Tennis',
                start: '2023-11-11 08:00:00',
                end: '2023-11-11 09:00:00',
                eventColor: 'red',
            },
            {
                title: 'Tennis',
                start: '2023-11-11 08:00:00',
                end: '2023-11-11 09:00:00',
                eventColor: 'red',
            },
            {
                title: 'Tennis',
                start: '2023-11-11 08:00:00',
                end: '2023-11-11 09:00:00',
                eventColor: 'red',
            },
            {
                title: 'Tennis',
                start: '2023-11-11 08:00:00',
                end: '2023-11-11 09:00:00',
                eventColor: 'red',
            },
            {
                title: 'Tennis',
                start: '2023-11-11 08:00:00',
                end: '2023-11-11 09:00:00',
                eventColor: 'red',
            },
            {
                title: 'Tennis',
                start: '2023-11-11 08:00:00',
                end: '2023-11-11 09:00:00',
                eventColor: 'red',
            },
            {
                title: 'Tennis',
                start: '2023-11-11 08:00:00',
                end: '2023-11-11 09:00:00',
                eventColor: 'red',
            },
            {
                title: 'Tennis',
                start: '2023-11-11 08:00:00',
                end: '2023-11-11 09:00:00',
                eventColor: 'red',
            },
            {
                title: 'Tennis',
                start: '2023-11-11 08:00:00',
                end: '2023-11-11 09:00:00',
                eventColor: 'red',
            },
            {
                title: 'Tennis',
                start: '2023-11-11 08:00:00',
                end: '2023-11-11 09:00:00',
                eventColor: 'red',
            },
            {
                title: 'Tennis',
                start: '2023-11-11 08:00:00',
                end: '2023-11-11 09:00:00',
                eventColor: 'red',
            },
            {
                title: 'Tennis',
                start: '2023-11-11 08:00:00',
                end: '2023-11-11 09:00:00',
                eventColor: 'red',
            },
            {
                title: 'Tennis',
                start: '2023-11-11 08:00:00',
                end: '2023-11-11 09:00:00',
                eventColor: 'red',
            },
            {
                title: 'Tennis',
                start: '2023-11-11 08:00:00',
                end: '2023-11-11 09:00:00',
                eventColor: 'red',
            },
            {
                title: 'Tennis',
                start: '2023-11-11 08:00:00',
                end: '2023-11-11 09:00:00',
                eventColor: 'red',
            },
            {
                title: 'Tennis',
                start: '2023-11-11 08:00:00',
                end: '2023-11-11 09:00:00',
                eventColor: 'red',
            },
          ],
        });
        calendar.render();
    });
</script>
@endsection

