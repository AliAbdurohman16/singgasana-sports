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
          <li>Booking</li>
        </ol>
        <h2>Booking Harian</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">

        <div class="container" data-aos="fade-up">

            <div class="container">
                <div class="row gy-4 justify-content-center">
                    <div class="col-lg-8 mb-3">
                        <form action="{{ route('booking.store') }}" method="post" id="member" class="form-booking">
                            @csrf
                            <div class="row gy-4">
                                <h4 class="text-center">Form Booking Harian</h4>
                                <div class="alert alert-warning" role="alert">
                                    Perhatian! Silahkan <b>Cek Jadwal</b> terlebih dahulu agar tidak terjadi bentrok jadwal.
                                    Klik <a href="{{ route('booking.schedule') }}" class="fw-bold" style="color:#523e02">Cek Jadwal</a> disini atau dimenu navigasi.
                                </div>
                                @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('message') }}
                                </div>
                                @elseif (Session::has('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ Session::get('error') }}
                                </div>
                                @endif
                                <div class="col-md-6">
                                    <input type="text" name="first_name" class="form-control" placeholder="Nama Depan" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="last_name" class="form-control" placeholder="Nama Belakang">
                                </div>
                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                </div>
                                <div class="col-md-6 ">
                                    <input type="number" class="form-control" name="telephone" placeholder="No Telepon" required>
                                </div>
                                <div class="col-md-12">
                                    <select name="service" class="form-control" required>
                                        <option value="">Pilih Layanan</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->name }}">{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <input type="date" class="form-control" name="datetime" id="datetime" placeholder="Tanggal Booking" required>
                                </div>
                                <div class="col-md-12" id="hideDuration">
                                    <select name="duration" class="form-control">
                                        <option value="">Pilih Durasi</option>
                                        <option value="1 Jam">1 Jam</option>
                                        <option value="2 Jam">2 Jam</option>
                                        <option value="3 Jam">3 Jam</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="fw-bold">Pembayaran</td>
                                            <td>:</td>
                                            <td>Cash</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Total</td>
                                            <td>:</td>
                                            <td class="total">Rp 0</td>
                                            <input type="hidden" name="total">
                                        </tr>
                                    </table>
                                </div>
                                <button type="submit">Booking</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- End Contact Section -->

</main><!-- End #main -->
@endsection

@section('script')
<script src="{{ asset('frontend') }}/assets/vendor/jquery/jquery.min.js"></script>
<script src="{{ asset('frontend') }}/assets/vendor/flatpickr/flatpickr.min.js"></script>
<script>
    flatpickr("#datetime", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        placeholder: "Tanggal Booking"
    });

    $(document).ready(function () {
        var hideDuration = $('#hideDuration').hide();

        $('select[name="service"], select[name="duration"]').change(function () {
            var service = $('select[name="service"]').val();
            var duration = $('select[name="duration"]').val();
            var price = 0;
            var total = 0;

            @foreach ($services as $service)
                if ("{{ $service->name }}" === service) {
                    price = {{ $service->price_daily }};
                }
            @endforeach

            if (service == "Swimming Pool") {
                hideDuration.hide();
                total = price;
            } else {
                hideDuration.show();

                var durationValue = parseInt(duration);

                if (isNaN(durationValue)) {
                    durationValue = 0;
                }

                total = durationValue * price;
            }

            $('.total').text('Rp ' + total.toLocaleString('id-ID'));
            $('input[name="total"]').val(total);
        });

    });
</script>
@endsection
