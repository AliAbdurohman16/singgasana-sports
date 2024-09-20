@extends('layouts.backend.main')

@section('title', 'Booking Member')

@section('content')
    <!-- Css -->
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/extensions/simple-datatables/style.css"/>
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/pages/simple-datatables.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/extensions/toastify-js/src/toastify.css"/>
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/extensions/sweetalert2/sweetalert2.min.css"/>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last mb-3">
                    <h3>Data Booking Member</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('booking.members') }}">Booking Member</a>
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
                {{-- <div class="card-header">
                    <button class="btn btn-primary btn-validation btn-sm mb-2"><i class="fas fa-qrcode"></i> Scan QR</button>
                </div> --}}
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
                            <th>Status</th>
                            <th width="20%">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($members as $row)
                            <tr>
                                <input type="hidden" class="delete_id" value="{{ $row->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->user->first_name ?? $row->first_name}} {{ $row->user->last_name ?? $row->last_name }}</td>
                                <td>{{ date('d-m-Y', strtotime($row->date)) }}</td>
                                <td>{{ date('H:s', strtotime($row->play_start)) }}</td>
                                <td>{{ date('H:s', strtotime($row->play_end)) }}</td>
                                <td>{{ $row->service->name }}</td>
                                <td>{{ $row->member }}</td>
                                <td>{{ $row->category }}</td>
                                <td>{{ $row->package }}</td>
                                <td>Rp {{ number_format($row->total, 0, ',', '.') }}</td>
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
                                    <button class="btn btn-primary btn-sm mb-2" onclick="window.location='members/{{ $row->id }}'"><i class="fas fa-eye"></i> Detail</button>
                                    @if ($row->status_payment == 'pending')
                                        <button class="btn btn-success btn-validation btn-sm mb-2" data-id="{{ $row->id }}"><i class="fas fa-check"></i> Validasi</button>
                                    @endif
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
    <script src="{{ asset('backend') }}/assets/extensions/toastify-js/src/toastify.js"></script>
    <script src="{{ asset('backend') }}/assets/extensions/sweetalert2/sweetalert2.min.js"></script>
    @if (Session::has('message'))
        <script>
            Toastify({
                text: "{{ Session::get('message') }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "center",
                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                progressBar: true,
            }).showToast();
        </script>
    @endif
    <script>
        $(document).on('click', '.btn-validation', function() {
            var id = $(this).data("id");
            Swal.fire({
                title: 'Hapus',
                text: "Apakah anda yakin ingin memvalidasi data ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#435ebe',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Validasi!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "members/" + id,
                        type: 'PUT',
                        data: {
                            "id": id,
                            "_token": $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function (response) {
                            swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            })
        });
    </script>
@endsection
