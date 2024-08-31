@extends('layouts.backend.main')

@section('title', 'Riwayat Booking')

@section('content')
    <!-- Css -->
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/extensions/simple-datatables/style.css"/>
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/pages/simple-datatables.css" />

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last mb-3">
                    <h3>Data Riwayat Booking</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('booking.histories') }}">Riwayat Booking</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                List
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <table class="table categories-table" id="table1">
                        <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Kode Booking</th>
                            <th>Nama Lengkap</th>
                            <th>Tanggal</th>
                            <th>Waktu Mulai</th>
                            <th>Waktu Selesai</th>
                            <th>Layanan</th>
                            <th>Member</th>
                            <th>Kategori</th>
                            <th>Paket</th>
                            <th>Total</th>
                            <th>Status Pembayaran</th>
                            <th>aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($histories as $row)
                            <tr>
                                <input type="hidden" class="delete_id" value="{{ $row->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->user->first_name }} {{ $row->user->last_name }}</td>
                                <td>{{ date('d-m-Y', strtotime($row->date)) }}</td>
                                <td>{{ date('H:s', strtotime($row->play_start)) }}</td>
                                <td>{{ empty($row->play_end) ? '' : date('H:i', strtotime($row->play_end)) }}</td>
                                <td>{{ $row->service->name }}</td>
                                <td>{{ $row->member }}</td>
                                <td>{{ $row->category }}</td>
                                <td>{{ $row->package }}</td>
                                <td>
                                    Rp {{ $row->package == 'Sekolah' ? number_format($row->total_for_school, 0, ',', '.') : number_format($row->total, 0, ',', '.') }}
                                </td>
                                <td>
                                    @if ($row->status_payment == 'pending')
                                        <span class="badge bg-secondary">Pending</span>
                                    @elseif ($row->status_payment == 'success')
                                        <span class="badge bg-success">Success</span>
                                    @else
                                        <span class="badge bg-danger">Expired</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm mb-2" onclick="window.location='histories/{{ $row->id }}'"><i class="fas fa-eye"></i> Detail</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- Basic Tables end -->
    </div>

    <!-- Js -->
    <script src="{{ asset('backend') }}/assets/extensions/jquery/jquery.min.js"></script>
    <script src="{{ asset('backend') }}/assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="{{ asset('backend') }}/assets/js/pages/simple-datatables.js"></script>
@endsection
