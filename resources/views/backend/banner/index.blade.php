@extends('layouts.backend.main')

@section('title', 'Banner')

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
          <h3>Data Banner</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('banners.index') }}">Banner</a>
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
        <div class="card-header">
            <button class="btn btn-primary btn-sm" onclick="window.location='/banners/create'"><i class="fas fa-plus"></i> Tambah Data</button>
        </div>
        <div class="card-body">
          <table class="table categories-table" id="table1">
            <thead>
              <tr>
                <th width="5%">No</th>
                <th>Foto</th>
                <th>Link</th>
                <th width="20%">Aksi</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($banners as $row)
              <tr>
                <input type="hidden" class="delete_id" value="{{ $row->id }}">
                <td>{{ $loop->iteration }}</td>
                <td>
                    <img src="{{ asset('storage/banner/' . $row->image) }}" width="100%" alt="image">
                </td>
                <td>{{ $row->link }}</td>
                <td>
                  <button class="btn btn-warning btn-sm mb-2" onclick="window.location='/banners/{{ $row->id }}/edit'"><i class="fas fa-edit"></i> Edit</button>
                  <button class="btn btn-danger btn-delete btn-sm mb-2" data-id="{{ $row->id }}"><i class="fas fa-trash"></i> Hapus</button>
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
                    url: "banners/" + id,
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
