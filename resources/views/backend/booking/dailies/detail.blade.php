@extends('layouts.backend.main')

@section('title', 'Detail Booking Harian')

@section('content')
<div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last mb-3">
          <h3>Detail Data</h3>
          <a href="{{ route('booking.dailies') }}" class="btn btn-warning btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('booking.dailies') }}">Booking Harian</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                Detail Data
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>

    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
          <div class="col-lg-8">
            <div class="card">
                <div class="container">
                    <table class="table table-borderless m-3">
                        <tr>
                            <td class="fw-bold">Nama Lengkap</td>
                            <td>:</td>
                            <td>{{ $daily->first_name }} {{ $daily->last_name }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Email</td>
                            <td>:</td>
                            <td>{{ $daily->email }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">No Telepon</td>
                            <td>:</td>
                            <td>{{ $daily->telephone }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Layanan</td>
                            <td>:</td>
                            <td>{{ $daily->service }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Durasi</td>
                            <td>:</td>
                            <td>{{ $daily->duration }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Tanggal Mulai</td>
                            <td>:</td>
                            <td>{{ date('d-m-Y H:i:s', strtotime($daily->datetime)) }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Tanggal Selesai</td>
                            <td>:</td>
                            <td>{{ date('d-m-Y H:i:s', strtotime($daily->expired)) }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Total</td>
                            <td>:</td>
                            <td>{{ number_format($daily->total, 0, ',', '.') }}</td>
                        </tr>
                        @if ($daily->status == 'success')
                            @if ($daily->service == 'Swimming Pool')
                                <tr>
                                    <td class="fw-bold">QR Code</td>
                                    <td>:</td>
                                    <td>
                                        {!! $daily->qr !!}
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td class="fw-bold">PIN</td>
                                    <td>:</td>
                                    <td class="fw-bold">{{ $daily->pin }}</td>
                                </tr>
                            @endif
                        @endif
                    </table>
                </div>
            </div>
          </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>

@endsection
