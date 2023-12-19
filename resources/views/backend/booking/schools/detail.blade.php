@extends('layouts.backend.main')

@section('title', 'Detail Booking Sekolah')

@section('content')
<div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last mb-3">
          <h3>Detail Data</h3>
          <a href="{{ route('booking.schools') }}" class="btn btn-warning btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('booking.schools') }}">Booking Sekolah</a>
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
            @foreach ($schools as $row)
            <div class="col-lg-6">
                <div class="card">
                    <div class="container">
                        <table class="table table-borderless m-3">
                            <tr>
                                <td class="fw-bold">Nama Lengkap</td>
                                <td>:</td>
                                <td>{{ $row->bookingMember->user->first_name }} {{ $row->bookingMember->user->last_name }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Email</td>
                                <td>:</td>
                                <td>{{ $row->bookingMember->user->email }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">No Telepon</td>
                                <td>:</td>
                                <td>{{ $row->bookingMember->user->telephone }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Layanan</td>
                                <td>:</td>
                                <td>{{ $row->bookingMember->service->name }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Tanggal Mulai</td>
                                <td>:</td>
                                <td>{{ date('d-m-Y H:i:s', strtotime($row->bookingMember->datetime)) }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Sekolah</td>
                                <td>:</td>
                                <td>{{ $row->bookingMember->school }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Jumlah Siswa</td>
                                <td>:</td>
                                <td>{{ $row->student_counts }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Expired</td>
                                <td>:</td>
                                <td>{{ date('d-m-Y H:i:s', strtotime($row->bookingMember->expired)) }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Subtotal</td>
                                <td>:</td>
                                <td>Rp {{ number_format($row->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>

@endsection
