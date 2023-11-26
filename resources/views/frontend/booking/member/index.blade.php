@extends('layouts.frontend.main')

@section('css')
<link href="{{ asset('frontend') }}/assets/vendor/flatpickr/flatpickr.min.css" rel="stylesheet">
@endsection

@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="{{ route('/') }}">Beranda</a></li>
          <li>Booking</li>
        </ol>
        <h2>Member</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">

        <div class="container" data-aos="fade-up">

            <div class="container">
                <div class="row gy-4 justify-content-center">
                    <div class="col-lg-8 mb-3">
                        <form action="{{ route('booking.storeMember') }}" method="post" id="member" class="form-booking">
                            @csrf
                            <div class="row gy-4">
                                <h4 class="text-center">Form Booking Member</h4>
                                <div class="alert alert-warning" role="alert">
                                    Perhatian! Jam Pemakaian 06.00 - 16.00 (Pagi) & 16.00 - 23.00 (Siang). Jika belum mempunyai akun silahkan <b>Daftar</b> terlebih dahulu untuk menjadi member.
                                    Klik <a href="{{ route('register') }}" class="fw-bold" style="color:#523e02">Daftar</a> disini atau dimenu navigasi.
                                </div>
                                @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('message') }}
                                </div>
                                @endif
                                <div class="col-md-12">
                                    <select name="service" class="form-control">
                                        <option value="">Pilih Layanan</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <input type="date" class="form-control" name="datetime" id="datetime" placeholder="Tanggal Mulai" required>
                                </div>
                                <div class="col-md-12" id="hideMember">
                                    <select name="member" class="form-control">
                                        <option value="">Pilih Member</option>
                                    </select>
                                </div>
                                <div class="col-md-12" id="hideCategory">
                                    <select name="category" class="form-control">
                                        <option value="">Pilih Kategori</option>
                                    </select>
                                </div>
                                <div class="col-md-12" id="hidePackage">
                                    <select name="package" class="form-control">
                                        <option value="">Pilih Paket</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="fw-bold">Pembayaran</td>
                                            <td>:</td>
                                            <td>Cash</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Total</td>
                                            <td>:</td>
                                            <td class="total">Rp 0</td>
                                            <input type="hidden" name="total">
                                        </tr>
                                    </table>
                                </div>
                                <button type="submit">Booking</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- End Contact Section -->

</main><!-- End #main -->
@endsection

@section('script')
<script src="{{ asset('frontend') }}/assets/vendor/jquery/jquery.min.js"></script>
<script src="{{ asset('frontend') }}/assets/vendor/flatpickr/flatpickr.min.js"></script>
<script>
    var prices = {!! json_encode($prices) !!};
</script>
<script>
    flatpickr("#datetime", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        placeholder: "Tanggal Booking",
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

    $(document).ready(function () {
        var hideMember = $('#hideMember').hide();
        var hideCategory = $('#hideCategory').hide();
        var hidePackage = $('#hidePackage').hide();

        $('select[name="service"]').change(function() {
            hideMember.show();
            hideCategory.show();
            hidePackage.show();
            var selectedService = $(this).val();
            var memberSelect = $('select[name="member"]');
            var categorySelect = $('select[name="category"]');
            var packageSelect = $('select[name="package"]');

            if (selectedService == 1) {
                memberSelect.empty().append(
                    '<option value="">Pilih Member</option>' +
                    '<option value="Personal">Personal</option>' +
                    '<option value="Couple">Couple</option>' +
                    '<option value="Triple">Triple</option>' +
                    '<option value="Family">Family</option>' +
                    '<option value="Student">Student</option>' +
                    '<option value="Swimming Club">Swimming Club</option>' +
                    '<option value="Community">Community</option>' +
                    '<option value="Corporate">Corporate</option>' +
                    '<option value="Ikawarna">Ikawarna</option>' +
                    '<option value="Pelatih Renang">Pelatih Renang</option>'
                );

                memberSelect.change(function() {
                    if ($(this).val() === "Personal" || $(this).val() === "Couple" || $(this).val() === "Triple" || $(this).val() === "Family") {
                        categorySelect.empty().append(
                            '<option value="">Pilih Kategori</option>' +
                            '<option value="Umum">Umum</option>' +
                            '<option value="Penghuni">Penghuni</option>'
                        );

                        packageSelect.empty().append(
                            '<option value="">Pilih Paket</option>' +
                            '<option value="Iuran Membership 2 Bulan">Iuran Membership 2 Bulan</option>' +
                            '<option value="Iuran Membership 6 Bulan">Iuran Membership 6 Bulan</option>'+
                            '<option value="Iuran Membership 12 Bulan">Iuran Membership 12 Bulan</option>'
                        );
                    } else if ($(this).val() === "Student") {
                        categorySelect.empty().append(
                            '<option value="">Pilih Kategori</option>' +
                            '<option value="Pelajar">Pelajar</option>'
                        );

                        packageSelect.empty().append(
                            '<option value="">Pilih Paket</option>' +
                            '<option value="Iuran Membership 2 Bulan">Iuran Membership 2 Bulan</option>' +
                            '<option value="Iuran Membership 6 Bulan">Iuran Membership 6 Bulan</option>'
                        );
                    } else if ($(this).val() === "Swimming Club") {
                        categorySelect.empty().append(
                            '<option value="">Pilih Kategori</option>' +
                            '<option value="Sekolah Olahraga">Sekolah Olahraga</option>'
                        );

                        packageSelect.empty().append(
                            '<option value="">Pilih Paket</option>' +
                            '<option value="Paket A - Pemula">Paket A - Pemula</option>' +
                            '<option value="Paket B - Prestasi Non Fitness">Paket B - Prestasi Non Fitness</option>' +
                            '<option value="Paket C - Prestasi + Fitness">Paket C - Prestasi + Fitness</option>' +
                            '<option value="Paket D - Pra Prestasi">Paket D - Pra Prestasi </option>'
                        );
                    } else if ($(this).val() === "Community" || $(this).val() === "Corporate" || $(this).val() === "Ikawarna") {
                        categorySelect.empty().append(
                            '<option value="">Pilih Kategori</option>' +
                            '<option value="Perusahaan">Perusahaan</option>'
                        );

                        packageSelect.empty().append(
                            '<option value="">Pilih Paket</option>' +
                            '<option value="Iuran Membership 2 Bulan (5 Orang)">Iuran Membership 2 Bulan (5 Orang)</option>' +
                            '<option value="Iuran Membership 2 Bulan (10 Orang)">Iuran Membership 2 Bulan (10 Orang)</option>' +
                            '<option value="Iuran Membership 6 Bulan (5 Orang)">Iuran Membership 6 Bulan (5 Orang)</option>' +
                            '<option value="Iuran Membership 6 Bulan (10 Orang)">Iuran Membership 6 Bulan (10 Orang)</option>'
                        );
                    } else if ($(this).val() === "Pelatih Renang") {
                        categorySelect.empty().append(
                            '<option value="">Pilih Kategori</option>' +
                            '<option value="Pelatih">Pelatih</option>'
                        );

                        packageSelect.empty().append(
                            '<option value="">Pilih Paket</option>' +
                            '<option value="Iuran Membership Pelatih Club 2 Bulan">Iuran Membership Pelatih Club 2 Bulan</option>' +
                            '<option value="Iuran Membership Pelatih Club + Fitness 2 Bulan">Iuran Membership Pelatih Club + Fitness 2 Bulan</option>'
                        );
                    }
                });
            } else if (selectedService == 2 || selectedService == 3) {
                hideMember.hide();

                categorySelect.empty().append(
                    '<option value="">Pilih Kategori</option>' +
                    '<option value="Umum">Umum</option>' +
                    '<option value="Penghuni">Penghuni</option>'
                );

                packageSelect.empty().append(
                    '<option value="">Pilih Paket</option>' +
                    '<option value="Per 2 Jam 1x Seminggu (PAGI)">Per 2 Jam 1x Seminggu (PAGI)</option>' +
                    '<option value="Per 3 Jam 1x Seminggu (PAGI)">Per 3 Jam 1x Seminggu (PAGI)</option>'+
                    '<option value="Per 2 Jam 1x Seminggu (SIANG)">Per 2 Jam 1x Seminggu (SIANG)</option>' +
                    '<option value="Per 4 Jam 1x Seminggu (SIANG)">Per 4 Jam 1x Seminggu (SIANG)</option>'
                );
            } else if (selectedService == 4) {
                hideMember.hide();

                categorySelect.empty().append(
                    '<option value="">Pilih Kategori</option>' +
                    '<option value="Umum">Umum</option>' +
                    '<option value="Penghuni">Penghuni</option>'
                );

                packageSelect.empty().append(
                    '<option value="">Pilih Paket</option>' +
                    '<option value="Per 2 Jam 1x Seminggu (PAGI)">Per 2 Jam 1x Seminggu (PAGI)</option>' +
                    '<option value="Per 3 Jam 1x Seminggu (PAGI)">Per 3 Jam 1x Seminggu (PAGI)</option>'+
                    '<option value="Per 3 Jam 1x Seminggu (SIANG)">Per 3 Jam 1x Seminggu (SIANG)</option>'
                );
            } else if (selectedService == 5) {
                hideMember.hide();

                categorySelect.empty().append(
                    '<option value="">Pilih Kategori</option>' +
                    '<option value="Umum">Umum</option>' +
                    '<option value="Penghuni">Penghuni</option>'
                );

                packageSelect.empty().append(
                    '<option value="">Pilih Paket</option>' +
                    '<option value="Per 2 Jam 1x Seminggu">Per 2 Jam 1x Seminggu</option>' +
                    '<option value="Per 3 Jam 1x Seminggu">Per 3 Jam 1x Seminggu</option>'+
                    '<option value="Paket Suka - Suka 10 Jam">Paket Suka - Suka 10 Jam</option>' +
                    '<option value="Paket Suka - Suka 12 Jam">Paket Suka - Suka 12 Jam</option>'+
                    '<option value="Paket Suka - Suka 15 Jam">Paket Suka - Suka 15 Jam</option>'
                );
            } else if (selectedService == 6) {
                hideMember.hide();

                categorySelect.empty().append(
                    '<option value="">Pilih Kategori</option>' +
                    '<option value="Umum">Umum</option>' +
                    '<option value="Penghuni">Penghuni</option>'
                );

                packageSelect.empty().append(
                    '<option value="">Pilih Paket</option>' +
                    '<option value="Per 1 Jam 1x Seminggu">Per 1 Jam 1x Seminggu</option>'
                );
            }
        });

        $('select[name="service"], select[name="category"], select[name="package"]').change(function () {
            var service = $('select[name="service"]').val();
            var category = $('select[name="category"]').val();
            var package = $('select[name="package"]').val();
            var total = 0;

            prices.forEach(function (price) {
                if (price.service_id == service) {
                    if (price.category == category) {
                        if (package === "Iuran Membership 2 Bulan") {
                            total = price.two_months;
                        } else if (package === "Iuran Membership 6 Bulan") {
                            total = price.six_months;
                        } else if (package === "Iuran Membership 12 Bulan") {
                            total = price.twelve_months;
                        } else if (package === "Paket A - Pemula") {
                            total = price.package_a;
                        } else if (package === "Paket B - Prestasi Non Fitness") {
                            total = price.package_b;
                        } else if (package === "Paket C - Prestasi + Fitness") {
                            total = price.package_c;
                        } else if (package === "Paket D - Pra Prestasi") {
                            total = price.package_d;
                        } else if (package === "Iuran Membership 2 Bulan (5 Orang)") {
                            total = price.two_months;
                        } else if (package === "Iuran Membership 2 Bulan (10 Orang)") {
                            total = price.two_months_ten_people;
                        } else if (package === "Iuran Membership 6 Bulan (5 Orang)") {
                            total = price.six_months;
                        } else if (package === "Iuran Membership 6 Bulan (10 Orang)") {
                            total = price.six_months_ten_people;
                        } else if (package === "Iuran Membership Pelatih Club 2 Bulan") {
                            total = price.member_coach_club_two_months;
                        } else if (package === "Iuran Membership Pelatih Club + Fitness 2 Bulan") {
                            total = price.member_coach_club_two_months_plus_fitness;
                        } else if (package === "Per 2 Jam 1x Seminggu (PAGI)") {
                            total = price.two_hours_morning;
                        } else if (package === "Per 3 Jam 1x Seminggu (PAGI)") {
                            total = price.three_hours_morning;
                        } else if (package === "Per 2 Jam 1x Seminggu (SIANG)") {
                            total = price.two_hours_afternoon;
                        } else if (package === "Per 4 Jam 1x Seminggu (SIANG)") {
                            total = price.four_hours_afternoon;
                        } else if (package === "Per 3 Jam 1x Seminggu (SIANG)") {
                            total = price.three_hours_afternoon;
                        } else if (package === "Per 1 Jam 1x Seminggu") {
                            total = price.one_hours;
                        } else if (package === "Per 2 Jam 1x Seminggu") {
                            total = price.two_hours;
                        } else if (package === "Per 3 Jam 1x Seminggu") {
                            total = price.three_hours;
                        } else if (package === "Paket Suka - Suka 10 Jam") {
                            total = price.ten_hours;
                        } else if (package === "Paket Suka - Suka 12 Jam") {
                            total = price.twelve_hours;
                        } else if (package === "Paket Suka - Suka 15 Jam") {
                            total = price.fifteen_hours;
                        }
                    }
                }
            });

            $('.total').text('Rp ' + total.toLocaleString('id-ID'));
            $('input[name="total"]').val(total);
        });
    });
</script>
@endsection
