@extends('layouts.backend.main')

@section('title', 'Data Swimming Pool')

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
          <h3>Data Swimming Pool</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="">Layanan</a>
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
                        <a class="nav-link active" id="daily-tab" data-bs-toggle="tab" href="#daily"
                            role="tab" aria-controls="daily" aria-selected="true">Harian</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="member-tab" data-bs-toggle="tab" href="#member"
                            role="tab" aria-controls="member" aria-selected="false">Member</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="school-tab" data-bs-toggle="tab" href="#school"
                            role="tab" aria-controls="school" aria-selected="false">Sekolah</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="daily" role="tabpanel" aria-labelledby="daily-tab">
                        <table class="table categories-table" id="table1">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Layanan</th>
                                    <th>Kategori</th>
                                    <th>Paket</th>
                                    <th>Harga Weekday</th>
                                    <th>Harga Weekend</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dailies as $row)
                                <tr>
                                    <input type="hidden" class="delete_id" value="{{ $row->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->service->name }}</td>
                                    <td>{{ $row->category }}</td>
                                    <td>{{ $row->package }}</td>
                                    <td>Rp {{ number_format($row->weekday, 0, ',', '.') }}</td>
                                    <td>{{ $row->weekend != NULL ? 'Rp ' . number_format($row->weekend, 0, ',', '.') : '' }}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm mb-2" onclick="window.location='/service/swimming-pool/daily/{{ $row->id }}'"><i class="fas fa-edit"></i> Edit</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="member" role="tabpanel" aria-labelledby="member-tab">
                        <table class="table categories-table" id="table2">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Layanan</th>
                                    <th>Member</th>
                                    <th>Kategori</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($members as $row)
                                <tr>
                                    <input type="hidden" class="delete_id" value="{{ $row->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->service->name }}</td>
                                    <td>{{ $row->member }}</td>
                                    <td>{{ $row->category }}</td>
                                    <td>
                                    <button class="btn btn-warning btn-sm mb-2" onclick="window.location='/service/swimming-pool/member/{{ $row->id }}'"><i class="fas fa-edit"></i> Edit</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="school" role="tabpanel" aria-labelledby="school-tab">
                        <a href="{{ route('swimmingPoolSchool.create') }}" class="mt-2 mb-2 btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
                        <table class="table categories-table" id="table3">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Layanan</th>
                                    <th>Member</th>
                                    <th>Sekolah</th>
                                    <th>Harga</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schools as $row)
                                <tr>
                                    <input type="hidden" class="delete_id" value="{{ $row->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->service->name }}</td>
                                    <td>{{ $row->member }}</td>
                                    <td>{{ $row->category }}</td>
                                    <td>Rp {{ number_format($row->price, 0, ',', '.') }}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm mb-2" onclick="window.location='/service/swimming-pool/school/{{ $row->id }}'"><i class="fas fa-edit"></i> Edit</button>
                                        <button class="btn btn-danger btn-delete btn-sm mb-2" data-id="{{ $row->id }}"><i class="fas fa-trash"></i> Hapus</button>
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
    $(document).on('click', '.btn-delete', function() {
        var id = $(this).data("id");
        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin ingin menghapus?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#435ebe',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "swimming-pool/school/" + id,
                    type: 'DELETE',
                    data: {
                        "id": id,
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
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
                });
            }
        })
    });
</script>
@endsection
