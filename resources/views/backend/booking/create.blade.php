@extends('layouts.backend.main')

@section('title', 'Daftar Booking')

@section('content')
<link href="{{ asset('frontend') }}/assets/vendor/flatpickr/flatpickr.min.css" rel="stylesheet">

<div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last mb-3">
          <h3>Daftar Booking</h3>
        </div>
      </div>
    </div>

    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
          <div class="col-lg-8">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('booking.storeMembers') }}" method="POST" class="form" data-parsley-validate>
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    @if (Session::has('message'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('message') }}
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="first-name-column">Layanan</label>
                                        <select name="service" class="form-control @error('service') is-invalid @enderror">
                                            <option value="">Pilih Layanan</option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('service')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Tanggal Mulai</label>
                                        <input type="text" name="datetime" id="datetime" class="form-control @error('datetime') is-invalid @enderror" value="{{ old('datetime') }}" placeholder="Tanggal Mulai" />
                                        @error('datetime')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Durasi</label>
                                        <select name="duration" class="form-control @error('duration') is-invalid @enderror">
                                            <option value="">Pilih Durasi</option>
                                            <option value="1 Bulan">1 Bulan</option>
                                        <option value="2 Bulan">2 Bulan</option>
                                        <option value="3 Bulan">3 Bulan</option>
                                        </select>
                                        @error('duration')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
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
<script src="{{ asset('frontend') }}/assets/vendor/jquery/jquery.min.js"></script>
<script src="{{ asset('frontend') }}/assets/vendor/flatpickr/flatpickr.min.js"></script>
<script>
    flatpickr("#datetime", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        placeholder: "Tanggal Booking"
    });

    $(document).ready(function () {
        $('select[name="service"], select[name="duration"]').change(function () {
            var service = $('select[name="service"]').val();
            var duration = $('select[name="duration"]').val();
            var price = 0;

            @foreach ($services as $service)
                if ("{{ $service->id }}" === service) {
                    price = {{ $service->price_member }};
                }
            @endforeach

            var durationValue = parseInt(duration);

            if (isNaN(durationValue)) {
                durationValue = 0;
            }

            var total = durationValue * price;

            $('.total').text('Rp ' + total.toLocaleString('id-ID'));
            $('input[name="total"]').val(total);
        });
    });
</script>
@endsection
