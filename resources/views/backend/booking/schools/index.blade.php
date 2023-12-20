@extends('layouts.backend.main')

@section('title', 'Booking Sekolah')

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
                    <h3>Data Booking Sekolah</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('booking.schools') }}">Booking Sekolah</a>
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
                    <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="attendance-tab" data-bs-toggle="tab" href="#attendance"
                                role="tab" aria-controls="attendance" aria-selected="true">Absen</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="validation-tab" data-bs-toggle="tab" href="#validation"
                                role="tab" aria-controls="validation" aria-selected="false">validasi</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="attendance" role="tabpanel" aria-labelledby="attendance-tab">
                            <table class="table categories-table" id="table1">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Layanan</th>
                                        <th>Tanggal Dibooking</th>
                                        <th>Sekolah</th>
                                        <th>Jml Siswa</th>
                                        <th width="20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($schools as $row)
                                    <tr>
                                        <input type="hidden" class="delete_id" value="{{ $row->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->bookingMember->service->name }}</td>
                                        <td>{{ date('d-m-Y H:i:s', strtotime($row->start_date)) }}</td>
                                        <td>{{ $row->school }}</td>
                                        <td>{{ $row->student_counts }}</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#border-less-attendance{{ $row->id }}"><i class="fas fa-user"></i> Siswa Tidak Hadir</button>
                                        </td>
                                    </tr>
                                    <div class="modal fade text-left modal-borderless" id="border-less-attendance{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Siswa Tidak Hadir</h5>
                                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                        <i data-feather="x"></i>
                                                    </button>
                                                </div>
                                                <form action="{{ route('booking.notPresent', $row->id ) }}" method="POST" class="form form-vertical">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-body">
                                                        <div class="col-md-12">
                                                            <label class="mb-2">Siswa Tidak Hadir</label>
                                                            <input type="text" class="form-control" name="not_present" placeholder="Siswa Tidak Hadir" autofocus required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                            <i class="fas fa-times d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Batal</span>
                                                        </button>
                                                        <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                                            <i class="fas fa-check d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Simpan</span>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="validation" role="tabpanel" aria-labelledby="validation-tab">
                            <table class="table categories-table" id="table2">
                                <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Kode Booking</th>
                                    <th>Nama Lengkap</th>
                                    <th>Layanan</th>
                                    <th>Tanggal Dibooking</th>
                                    <th>Sekolah</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($schools as $row)
                                    <tr>
                                        <input type="hidden" class="delete_id" value="{{ $row->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->booking_member_id }}</td>
                                        <td>{{ $row->bookingMember->user->first_name }} {{ $row->bookingMember->user->last_name }}</td>
                                        <td>{{ $row->bookingMember->service->name }}</td>
                                        <td>{{ date('d-m-Y H:i:s', strtotime($row->bookingMember->datetime)) }}</td>
                                        <td>{{ $row->school }}</td>
                                        <td>Rp {{ number_format($row->bookingMember->total, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($row->bookingMember->status == 'pending')
                                                <span class="badge bg-secondary">Belum Bayar</span>
                                            @elseif ($row->bookingMember->status == 'success')
                                                <span class="badge bg-success">Sudah Bayar</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm mb-2" onclick="window.location='schools/{{ $row->booking_member_id }}'"><i class="fas fa-eye"></i> Detail</button>
                                            @if ($row->bookingMember->status == 'pending')
                                                <button class="btn btn-success btn-validation btn-sm mb-2" data-id="{{ $row->booking_member_id }}"><i class="fas fa-check"></i> Validasi</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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
                        url: "schools/" + id,
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
