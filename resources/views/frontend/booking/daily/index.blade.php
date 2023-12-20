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
                <h2>Booking Harian</h2>

            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">

            <div class="container" data-aos="fade-up">

                <div class="container">
                    <div class="row gy-4 justify-content-center">
                        <div class="col-lg-8 mb-3">
                            <form action="{{ route('booking.store') }}" method="post" id="member" class="form-booking">
                                @csrf
                                <div class="row gy-4">
                                    <h4 class="text-center">Form Booking Harian</h4>
                                    <div class="alert alert-warning" role="alert">
                                        Perhatian! Jam Pemakaian 06.00 - 16.00 (Pagi) & 16.00 - 23.00 (Siang). Silahkan
                                        <b>Cek Jadwal</b> terlebih dahulu agar tidak terjadi bentrok jadwal.
                                        Klik <a href="{{ route('booking.schedule') }}" class="fw-bold"
                                            style="color:#523e02">Cek Jadwal</a> disini atau dimenu navigasi.
                                    </div>
                                    @if (Session::has('message'))
                                        <div class="alert alert-success" role="alert">
                                            {{ Session::get('message') }}
                                        </div>
                                    @elseif (Session::has('error'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ Session::get('error') }}
                                        </div>
                                    @endif
                                    <div class="col-md-6">
                                        <input type="text" name="first_name" class="form-control"
                                            placeholder="Nama Depan" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="last_name" class="form-control"
                                            placeholder="Nama Belakang">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" name="email" placeholder="Email"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" name="telephone" placeholder="No Telepon"
                                            required>
                                    </div>
                                    <div class="col-md-12">
                                        <select name="service" class="form-control" required>
                                            <option value="">Pilih Layanan</option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="date" class="form-control" name="datetime" id="datetime"
                                            placeholder="Tanggal Booking" required>
                                    </div>
                                    <div class="col-md-12" id="hideCategory">
                                        <select name="category" class="form-control">
                                            <option value="">Pilih Kategori</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12" id="hideUsage">
                                        <select name="usage" class="form-control">
                                            <option value="">Pilih Lapangan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12" id="hidePackage">
                                        <div class="row mb-3">
                                            <label for="dewasa" class="col-sm-8 col-form-label">Paket Dewasa</label>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <button class="btn btn-outline-secondary minus" type="button" id="minusDewasa" data-target="dewasa">-</button>
                                                    <input type="number" id="dewasa" name="dewasa" class="form-control text-center" min="0" value="0" disabled>
                                                    <button class="btn btn-outline-secondary plus" type="button" id="plusDewasa" data-target="dewasa">+</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="anak" class="col-sm-8 col-form-label">Paket Anak</label>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <button class="btn btn-outline-secondary minus" type="button" id="minusAnak" data-target="anak">-</button>
                                                    <input type="number" id="anak" name="anak" class="form-control text-center" min="0" value="0" disabled>
                                                    <button class="btn btn-outline-secondary plus" type="button" id="plusAnak" data-target="anak">+</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="pengantar" class="col-sm-8 col-form-label">Paket Pengantar</label>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <button class="btn btn-outline-secondary minus" type="button" id="minusPengantar" data-target="pengantar">-</button>
                                                    <input type="number" id="pengantar" name="pengantar" class="form-control text-center" min="0" value="0" disabled>
                                                    <button class="btn btn-outline-secondary plus" type="button" id="plusPengantar" data-target="pengantar">+</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="buku" class="col-sm-8 col-form-label">Paket Tiket Buku (15 Lembar)</label>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <button class="btn btn-outline-secondary minus" type="button" id="minusBuku" data-target="buku">-</button>
                                                    <input type="number" id="buku" name="buku" class="form-control text-center" min="0" value="0" disabled>
                                                    <button class="btn btn-outline-secondary plus" type="button" id="plusBuku" data-target="buku">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="hideSchedule">
                                        <select name="scheduleOption" id="scheduleOption" class="form-control" disabled>
                                            <option value="">Pilih Jadwal</option>
                                            <option value="Weekday">Weekday</option>
                                            <option value="Weekend">Weekend</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12" hidden>
                                        <input type="text" name="schedule" id="schedule">
                                    </div>
                                    <div class="col-md-12" id="hideDuration">
                                        <select name="duration" class="form-control">
                                            <option value="">Pilih Durasi</option>
                                            <option value="1 Jam">1 Jam</option>
                                            <option value="2 Jam">2 Jam</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table-borderless table">
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
                    longhand: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                        'September', 'Oktober', 'November', 'Desember'
                    ]
                }
            },
            onChange: (selectedDates, dateStr, instance) => {
                let total = 0;
                var str = selectedDates.toString();
                let schedule = document.getElementById('scheduleOption');
                let schdl = document.getElementById('schedule');
                if (str.substring(0, 3) === 'Sat' || str.substring(0, 3) === 'Sun') {
                    schedule.value = "Weekend";
                    schdl.value = "Weekend";
                } else {
                    schedule.value = "Weekday";
                    schdl.value= "Weekday";
                }
            },
        });

        let packageCount = 1;
        const packageContainer = document.getElementById('packageContainer');

        function addPackage() {
            const newSelect = document.createElement('select');
            newSelect.setAttribute('name', 'package[]');
            newSelect.setAttribute('class', 'form-control flex-fill mt-3');
            newSelect.setAttribute('id', 'packageSelect' + packageCount);

            const options = [
                { value: '', text: 'Pilih Paket' },
                { value: 'Dewasa', text: 'Dewasa' },
                { value: 'Anak', text: 'Anak' },
                { value: 'Pengantar', text: 'Pengantar' },
                { value: 'Tiket Buku (15 Lembar)', text: 'Tiket Buku (15 Lembar)' }
            ];

            options.forEach(optionData => {
                const option = document.createElement('option');
                option.setAttribute('value', optionData.value);
                option.appendChild(document.createTextNode(optionData.text));
                newSelect.appendChild(option);
            });

            const amountInput = document.createElement('input');
            amountInput.setAttribute('type', 'number');
            amountInput.setAttribute('name', 'amount[]');
            amountInput.setAttribute('class', 'form-control ms-2 mt-3');
            amountInput.setAttribute('placeholder', 'Jumlah');
            amountInput.setAttribute('id', 'amountInput' + packageCount);

            const removeButton = document.createElement('button');
            removeButton.setAttribute('type', 'button');
            removeButton.setAttribute('class', 'btn btn-danger mt-3');
            removeButton.innerHTML = '<i class="bi bi-x"></i>';
            removeButton.addEventListener('click', function() {
                const parentDiv = removeButton.parentNode.parentNode;
                if (packageContainer.contains(parentDiv)) {
                    parentDiv.style.display = 'none';
                    packageCount--;
                } else {
                    console.error("Error: Parent div not found in packageContainer");
                }
            });

            const packageInputGroupAppend = document.createElement('div');
            packageInputGroupAppend.setAttribute('class', 'input-group-append ms-2');
            packageInputGroupAppend.appendChild(removeButton);

            const packageInputGroup = document.createElement('div');
            packageInputGroup.setAttribute('class', 'input-group');
            packageInputGroup.appendChild(newSelect);
            packageInputGroup.appendChild(amountInput);
            packageInputGroup.appendChild(packageInputGroupAppend);

            const packageDiv = document.createElement('div');
            packageDiv.setAttribute('class', 'col-md-12');
            packageDiv.appendChild(packageInputGroup);

            packageContainer.appendChild(packageDiv);

            packageCount++;
        }

        $(document).ready(function() {
            $('#plusDewasa').click(function () {
                var currentValue = parseInt($('#dewasa').val());
                $('#dewasa').val(currentValue + 1);
             });

            $('#minusDewasa').click(function () {
                var currentValue = parseInt($('#dewasa').val());
                if (currentValue > 0) {
                    $('#dewasa').val(currentValue - 1);
                }
            });

            $('#plusAnak').click(function () {
                var currentValue = parseInt($('#anak').val());
                $('#anak').val(currentValue + 1);
            });

            $('#minusAnak').click(function () {
                var currentValue = parseInt($('#anak').val());
                if (currentValue > 0) {
                    $('#anak').val(currentValue - 1);
                }
            });

            $('#plusPengantar').click(function () {
                var currentValue = parseInt($('#pengantar').val());
                $('#pengantar').val(currentValue + 1);
            });

            $('#minusPengantar').click(function () {
                var currentValue = parseInt($('#pengantar').val());
                if (currentValue > 0) {
                    $('#pengantar').val(currentValue - 1);
                }
            });

            $('#plusBuku').click(function () {
                var currentValue = parseInt($('#buku').val());
                $('#buku').val(currentValue + 1);
            });

            $('#minusBuku').click(function () {
                var currentValue = parseInt($('#buku').val());
                if (currentValue > 0) {
                    $('#buku').val(currentValue - 1);
                }
            });

            var hideCategory = $('#hideCategory').hide();
            var hideUsage = $('#hideUsage').hide();
            var hidePackage = $('#hidePackage').hide();
            var hideSchedule = $('#hideSchedule').hide();
            var hideDuration = $('#hideDuration').hide();
            var hidePackageBtn = $('#hidePackageBtn').hide();

            $('select[name="service"]').change(function() {
                var selectedService = $(this).val();
                var categorySelect = $('select[name="category"]');

                if (selectedService == 1) {
                    hideCategory.hide();
                    hidePackage.show();
                    hideSchedule.show();
                    hidePackageBtn.show();

                    $('#addPackageBtn').click(function() {
                        var htmlToAdd = `
                        <div class="col-md-12 mb-3">
                            <div class="input-group">
                                <select name="package" class="form-control flex-fill">
                                    <option value="">Pilih Paket</option>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-primary ms-2 removePackageBtn">
                                        <i class="bi bi-x"></i> Remove
                                    </button>
                                </div>
                            </div>
                        </div>`;

                        var packagesContainer = $('#packagesContainer');
                        packagesContainer.append(htmlToAdd);

                        $('.removePackageBtn').click(function() {
                            $(this).closest('.col-md-12').remove();
                        });
                    });

                    hideUsage.hide();
                    hideDuration.hide();
                } else if (selectedService == 5 || selectedService == 6) {
                    hideCategory.show();

                    categorySelect.empty().append(
                        '<option value="">Pilih Kategori</option>' +
                        '<option value="Umum">Umum</option>' +
                        '<option value="Penghuni">Penghuni</option>'
                    );

                    var usageSelect = $('select[name="usage"]');
                    usageSelect.empty().append(
                        '<option value="">Pilih Lapangan</option>'
                    );

                    hideUsage.hide();
                    hideDuration.show();
                    hidePackage.hide();
                    hideSchedule.hide();
                    hidePackageBtn.hide();
                } else {
                    hideCategory.show();

                    categorySelect.empty().append(
                        '<option value="">Pilih Kategori</option>' +
                        '<option value="Umum">Umum</option>' +
                        '<option value="Penghuni">Penghuni</option>'
                    );

                    var usageSelect = $('select[name="usage"]');
                    usageSelect.empty().append(
                        '<option value="">Pilih Lapangan</option>' +
                        '<option value="Lapang (PAGI)">Lapang (PAGI)</option>' +
                        '<option value="Lapang (SIANG)">Lapang (SIANG)</option>'
                    );

                    hideUsage.show();
                    hideDuration.show();
                    hidePackage.hide();
                    hideSchedule.hide();
                    hidePackageBtn.hide();
                }
            });

            function updateTotal(total) {
                total = total || 0;
                $('.total').text('Rp ' + total.toLocaleString('id-ID'));
                $('input[name="total"]').val(total);
            }

            // $('select[name="scheduleOption"], #dewasa, #anak, #pengantar, #buku').on('change input', function() {
            //     var schedule = $('select[name="scheduleOption"]').val();
            //     var dewasa = parseInt($('#dewasa').val()) || 0;
            //     var anak = parseInt($('#anak').val()) || 0;
            //     var pengantar = parseInt($('#pengantar').val()) || 0;
            //     var buku = parseInt($('#buku').val()) || 0;
            //     var total = 0;

            //     prices.forEach(function(price) {
            //         if (dewasa !== 0 && price.package === "Paket Dewasa") {
            //             if (schedule === "Weekday") {
            //                 total += price.weekday * dewasa;
            //             } else if (schedule === "Weekend") {
            //                 total += price.weekend * dewasa;
            //             }
            //         }

            //         if (anak !== 0 && price.package === "Paket Anak") {
            //             if (schedule === "Weekday") {
            //                 total += price.weekday * anak;
            //             } else if (schedule === "Weekend") {
            //                 total += price.weekend * anak;
            //             }
            //         }

            //         if (pengantar !== 0 && price.package === "Pengantar") {
            //             if (schedule === "Weekday") {
            //                 total += price.weekday * pengantar;
            //             } else if (schedule === "Weekend") {
            //                 total += price.weekend * pengantar;
            //             }
            //         }

            //         if (buku !== 0 && price.package === "Tiket Buku (15 Lembar)") {
            //             if (schedule === "Weekday") {
            //                 total += price.weekday * buku;
            //             } else if (schedule === "Weekend") {
            //                 total += price.weekend * buku;
            //             }
            //         }
            //     });

            //     updateTotal(total);
            // });

            $('select[name="service"], select[name="category"], select[name="usage"], select[name="duration"]')
                .change(function() {
                    var category = $('select[name="category"]').val();
                    var duration = $('select[name="duration"]').val();
                    var service = $('select[name="service"]').val();
                    var usage = $('select[name="usage"]').val();
                    var durationValue = parseInt(duration);
                    var total = 0;

                    if (isNaN(durationValue)) {
                        durationValue = 0;
                    }

                    prices.forEach(function(price) {
                        if (price.service_id == service) {
                            if (price.category == category) {
                                if (usage == 'Lapang (PAGI)') {
                                    total = durationValue * price.morning;
                                } else if (usage == 'Lapang (SIANG)') {
                                    total = durationValue * price.afternoon;
                                } else if (usage == '') {
                                    total = durationValue * price.price;
                                }
                            }
                        }
                    });

                    updateTotal(total);
                });
        });
    </script>
@endsection
