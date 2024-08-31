@extends('layouts.backend.main')

@section('title', 'Detail Booking Sekolah')

@section('content')
<div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last mb-3">
          <h3>Detail Data</h3>
          <a href="{{ route('booking.histories') }}" class="btn btn-warning btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('booking.histories') }}">Riwayat Booking</a>
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
            @if ($member->package == 'Sekolah')
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
                                    <td>{{ date('d-m-Y H:i:s', strtotime($row->start_date)) }}</td>
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
                                    <td class="fw-bold">Expired Biometrik (QR)</td>
                                    <td>:</td>
                                    <td>{{ date('d-m-Y H:i:s', strtotime($row->bookingMember->expired_biometrik)) }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Status Biometrik (QR)</td>
                                    <td>:</td>
                                    <td>{{ ucfirst($row->bookingMember->status_biometrik) }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Subtotal</td>
                                    <td>:</td>
                                    <td>Rp {{ number_format($row->subtotal, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">PPN {{ $setting->ppn }}%</td>
                                    <td>:</td>
                                    <td>Rp {{ number_format($row->ppn, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Total</td>
                                    <td>:</td>
                                    <td>Rp {{ number_format($row->total, 0, ',', '.') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-lg-8">
                    <div class="card">
                        <div class="container">
                            <table class="table table-borderless m-3">
                                <tr>
                                    <td class="fw-bold">Nama Lengkap</td>
                                    <td>:</td>
                                    <td>{{ $member->user->first_name }} {{ $member->user->last_name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Email</td>
                                    <td>:</td>
                                    <td>{{ $member->user->email }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">No Telepon</td>
                                    <td>:</td>
                                    <td>{{ $member->user->telephone }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Tanggal</td>
                                    <td>:</td>
                                    <td>{{ date('d-m-Y', strtotime($member->date)) }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Waktu Mulai</td>
                                    <td>:</td>
                                    <td>{{ date('H:i:s', strtotime($member->play_start)) }}</td>
                                </tr>
                                @if (!empty($member->play_end))
                                <tr>
                                    <td class="fw-bold">Waktu Selesai</td>
                                    <td>:</td>
                                    <td>{{ date('H:i:s', strtotime($member->play_end)) }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="fw-bold">Layanan</td>
                                    <td>:</td>
                                    <td>{{ $member->service->name }}</td>
                                </tr>
                                @if (!empty($member->member))
                                <tr>
                                    <td class="fw-bold">Member</td>
                                    <td>:</td>
                                    <td>{{ $member->member }}</td>
                                </tr>
                                @endif
                                @if (!empty($member->category))
                                <tr>
                                    <td class="fw-bold">Kategori</td>
                                    <td>:</td>
                                    <td>{{ $member->category }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="fw-bold">Paket</td>
                                    <td>:</td>
                                    <td>{{ $member->package }}</td>
                                </tr>
                                @if ($member->category == 'Penghuni')
                                <tr>
                                    <td class="fw-bold">Bukti Identitas Penghuni</td>
                                    <td>:</td>
                                    <td>
                                        <img src="{{ asset('storage/booking-member/' . $member->identity) }}" width="50%" alt="identitas">
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                  <td class="fw-bold">Subtotal</td>
                                  <td>:</td>
                                  <td>{{ number_format($member->subtotal, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                  <td class="fw-bold">PPN {{ $setting->ppn }}%</td>
                                  <td>:</td>
                                  <td>{{ number_format($member->ppn, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                  <td class="fw-bold">Total</td>
                                  <td>:</td>
                                  <td>{{ number_format($member->total, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Expired Pembayaran</td>
                                    <td>:</td>
                                    <td>{{ date('d-m-Y H:i:s', strtotime($member->expired_payment)) }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Status Pembayaran</td>
                                    <td>:</td>
                                    <td>{{ ucfirst($member->status_payment) }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Expired Biometrik (QR dan PIN)</td>
                                    <td>:</td>
                                    <td>{{ date('d-m-Y H:i:s', strtotime($member->expired_biometrik)) }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Status Biometrik (QR dan PIN)</td>
                                    <td>:</td>
                                    <td>{{ ucfirst($member->status_biometrik) }}</td>
                                </tr>
                                @if ($member->status_biometrik == 'success')
                                    @if ($member->service_id == 1)
                                        <tr>
                                            <td class="fw-bold">QR Code</td>
                                            <td>:</td>
                                            <td>
                                                <img src="{{ asset('singgasana-sport/public/qr_codes/' . $member->qr) }}" width="20%" alt="QR Code">
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="fw-bold">PIN</td>
                                            <td>:</td>
                                            <td class="fw-bold">{{ $member->pin }}</td>
                                        </tr>
                                    @endif
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>

@endsection
