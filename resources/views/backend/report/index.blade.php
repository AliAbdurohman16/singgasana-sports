    @extends('layouts.backend.main')

    @section('title', 'Report')

    @section('content')
    <link href="{{ asset('frontend') }}/assets/vendor/flatpickr/flatpickr.min.css" rel="stylesheet">

    <div class="page-heading">
        <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last mb-3">
            <h3>Report</h3>
            </div>
        </div>
        </div>

        <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <div class="row match-height">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('report.export') }}" method="GET" class="form" data-parsley-validate>
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        @if (Session::has('message'))
                                        <div class="alert alert-success" role="alert">
                                            {{ Session::get('message') }}
                                        </div>
                                        @elseif (Session::has('error'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ Session::get('error') }}
                                        </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="first-name-column">Dari Tanggal</label>
                                            <input type="text" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}" placeholder="yyyy-mm-dd --:--" />
                                            @error('start_date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name-column">Sampai Tanggal</label>
                                            <input type="text" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}" placeholder="yyyy-mm-dd --:--" />
                                            @error('end_date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center mt-4">
                                        <input type="submit" class="btn btn-primary me-1 mb-1 btn-block" value="Export Excel">
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <!-- // Basic multiple Column Form section end -->
    </div>
    <script src="{{ asset('frontend') }}/assets/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/vendor/flatpickr/flatpickr.min.js"></script>
    <script>
        flatpickr("#start_date", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            placeholder: "yyyy-mm-dd --:--",
            time_24hr: true,
            locale: {
                firstDayOfWeek: 1,
                weekdays: {
                    shorthand: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                    longhand: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']
                },
                months: {
                    shorthand: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    longhand: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
                }
            }
        });

        flatpickr("#end_date", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            placeholder: "yyyy-mm-dd --:--",
            time_24hr: true,
            locale: {
                firstDayOfWeek: 1,
                weekdays: {
                    shorthand: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                    longhand: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']
                },
                months: {
                    shorthand: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    longhand: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
                }
            }
        });
    </script>
    @endsection
