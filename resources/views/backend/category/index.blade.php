@extends('layouts.backend.main')

@section('title', 'Kategori')

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
          <h3>Data Kategori</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('category.index') }}">Kategori</a>
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
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#border-less-add"><i class="fas fa-plus"></i> Tambah Data</button>
        </div>
        <div class="card-body">
          <table class="table categories-table" id="table1">
            <thead>
              <tr>
                <th width="5%">No</th>
                <th>Judul</th>
                <th>Slug</th>
                <th width="20%">Aksi</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($categories as $row)
              <tr>
                <input type="hidden" class="delete_id" value="{{ $row->id }}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->title }}</td>
                <td>{{ $row->slug }}</td>
                <td>
                  <button class="btn btn-warning btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#border-less-edit{{ $row->id }}"><i class="fas fa-edit"></i> Edit</button>
                  <button class="btn btn-danger btn-sm mb-2 btn-delete" data-id="{{ $row->id }}"><i class="fas fa-trash"></i> Hapus</button>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </section>
    <!-- Basic Tables end -->

    <!-- BorderLess Modal Add -->
    <div class="modal fade text-left modal-borderless" id="border-less-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="{{ route('category.store') }}" method="POST" class="form form-vertical">
                    @csrf
                    <div class="modal-body">
                        <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                            <label>Kategori</label>
                            </div>
                            <div class="col-md-8 form-group">
                            <input type="text" class="form-control" name="title" placeholder="Kategori" autofocus value="{{ old('title') }}" required>
                            </div>
                        </div>
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

    <!-- BorderLess Modal Edit -->
    @foreach ($categories as $row)
    <div class="modal fade text-left modal-borderless" id="border-less-edit{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="{{ route('category.update', $row->id ) }}" method="POST" class="form form-vertical">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                            <label>Kategori</label>
                            </div>
                            <div class="col-md-8 form-group">
                            <input type="text" class="form-control" name="title" placeholder="Kategori" autofocus value="{{ $row->title }}" required>
                            </div>
                        </div>
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
                    url: "category/" + id,
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
