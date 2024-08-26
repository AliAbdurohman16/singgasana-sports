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
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>No Telp</th>
                            <th>Layanan</th>
                            <th>Paket</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($histories as $row)
                            <tr>
                                <input type="hidden" class="delete_id" value="{{ $row->id }}">
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $row->user->first_name }} {{ $row->user->last_name }}</td>
                                <td>{{ $row->user->email }}</td>
                                <td>{{ $row->user->telephone }}</td>
                                <td>{{ $row->service->name }}</td>
                                <td>{{ $row->package }}</td>
                                <td>Rp {{ number_format($row->total, 0, ',', '.') }}</td>
                                <td>
                                    @if ($row->status == 'pending')
                                        <span class="badge bg-secondary">Pending</span>
                                    @elseif ($row->status == 'success')
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
