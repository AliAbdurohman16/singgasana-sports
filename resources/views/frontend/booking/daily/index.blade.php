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
                            <form action="{{ route('booking.store') }}" method="post" id="member" class="form-booking" enctype="multipart/form-data">
                                @csrf
                                <div class="row gy-4">
                                    <h4 class="text-center">Form Booking Harian</h4>
                                    <div class="alert alert-warning" role="alert">
                                        Perhatian! Jam Pemakaian 06.00 - 16.00 (Pagi) & 16.00 - 23.00 (Malam). Silahkan
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
                                                    <input type="number" id="dewasa" name="dewasa" class="form-control text-center" min="0" value="0" readonly>
                                                    <button class="btn btn-outline-secondary plus" type="button" id="plusDewasa" data-target="dewasa">+</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="anak" class="col-sm-8 col-form-label">Paket Anak</label>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <button class="btn btn-outline-secondary minus" type="button" id="minusAnak" data-target="anak">-</button>
                                                    <input type="number" id="anak" name="anak" class="form-control text-center" min="0" value="0" readonly>
                                                    <button class="btn btn-outline-secondary plus" type="button" id="plusAnak" data-target="anak">+</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="pengantar" class="col-sm-8 col-form-label">Paket Pengantar</label>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <button class="btn btn-outline-secondary minus" type="button" id="minusPengantar" data-target="pengantar">-</button>
                                                    <input type="number" id="pengantar" name="pengantar" class="form-control text-center" min="0" value="0" readonly>
                                                    <button class="btn btn-outline-secondary plus" type="button" id="plusPengantar" data-target="pengantar">+</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="buku" class="col-sm-8 col-form-label">Paket Tiket Buku (15 Lembar)</label>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <button class="btn btn-outline-secondary minus" type="button" id="minusBuku" data-target="buku">-</button>
                                                    <input type="number" id="buku" name="buku" class="form-control text-center" min="0" value="0" readonly>
                                                    <button class="btn btn-outline-secondary plus" type="button" id="plusBuku" data-target="buku">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="hideFitnessPackage">
                                        <select name="fitnessPackage" id="fitnessPackage" class="form-control" disabled></select>
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
                                    <div class="col-md-12" id="hideIdentity">
                                        <input type="file" name="identity" class="form-control mb-2">
                                        <small>Syarat harga khusus penghuni harus upload bukti identitas/KTP *</small>
                                    </div>
                                    <div class="col-md-12" id="hideLamp">
                                        <select name="lamp" class="form-control">
                                            <option value="">Pilih Sewa Lampu</option>
                                            <option value="Ya">Ya</option>
                                            <option value="Tidak">Tidak</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12" id="hideBall">
                                        <select name="ball" class="form-control">
                                            <option value="">Pilih Sewa Bola</option>
                                            <option value="Ya">Ya</option>
                                            <option value="Tidak">Tidak</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12" id="hideRacket">
                                        <select name="racket" class="form-control">
                                            <option value="">Pilih Sewa Raket</option>
                                            <option value="Ya">Ya</option>
                                            <option value="Tidak">Tidak</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12" id="hideBet">
                                        <select name="bet" class="form-control">
                                            <option value="">Pilih Sewa Bet</option>
                                            <option value="Ya">Ya</option>
                                            <option value="Tidak">Tidak</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table-borderless table">
                                            <tr>
                                                <td class="fw-bold">Pembayaran</td>
                                                <td>:</td>
                                                <td>Transfer</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">Subtotal</td>
                                                <td>:</td>
                                                <td class="subtotal">Rp 0</td>
                                                <input type="hidden" name="subtotal">
                                            </tr>
                                            <tr class="hideRentLights">
                                                <td class="fw-bold">Sewa Lampu</td>
                                                <td>:</td>
                                                <td class="rent_lights">Rp 0</td>
                                                <input type="hidden" name="rent_lights">
                                            </tr>
                                            <tr class="hideRentBall">
                                                <td class="fw-bold">Sewa Bola</td>
                                                <td>:</td>
                                                <td class="rent_ball">Rp 0</td>
                                                <input type="hidden" name="rent_ball">
                                            </tr>
                                            <tr class="hideRentRacket">
                                                <td class="fw-bold">Sewa Raket</td>
                                                <td>:</td>
                                                <td class="rent_racket">Rp 0</td>
                                                <input type="hidden" name="rent_racket">
                                            </tr>
                                            <tr class="hideRentBet">
                                                <td class="fw-bold">Sewa Bet</td>
                                                <td>:</td>
                                                <td class="rent_bet">Rp 0</td>
                                                <input type="hidden" name="rent_bet">
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">PPN {{ $setting->ppn }}%</td>
                                                <td>:</td>
                                                <td class="ppn">Rp 0</td>
                                                <input type="hidden" name="ppn">
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
            var hideFitnessPackage = $('#hideFitnessPackage').hide();
            var hideIdentity = $('#hideIdentity').hide();
            var hideLamp = $('#hideLamp').hide();
            var hideBall = $('#hideBall').hide();
            var hideRacket = $('#hideRacket').hide();
            var hideBet = $('#hideBet').hide();
            var hideRentLights = $('.hideRentLights').hide();
            var hideRentBall = $('.hideRentBall').hide();
            var hideRentRacket = $('.hideRentRacket').hide();
            var hideRentBet = $('.hideRentBet').hide();

            $('select[name="service"]').change(function() {
                var selectedService = $(this).val();
                var categorySelect = $('select[name="category"]');
                var fitnessPackage = $('select[name="fitnessPackage"]');

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

                    hideIdentity.hide();
                    hideUsage.hide();
                    hideDuration.hide();
                    hideFitnessPackage.hide();
                    hideLamp.hide();
                    hideRentLights.hide();
                    hideBall.hide();
                    hideRentBall.hide();
                    hideBet.hide();
                    hideRentBet.hide();
                    hideRacket.hide();
                    hideRentRacket.hide();
                    $('select[name="lamp"]').val('');
                    $('input[name="rent_lights"]').val('');
                    $('select[name="ball"]').val('');
                    $('input[name="rent_ball"]').val('');
                    $('select[name="racket"]').val('');
                    $('input[name="rent_racket"]').val('');
                    $('select[name="bet"]').val('');
                    $('input[name="rent_bet"]').val('');
                } else if (selectedService == 5 || selectedService == 6) {
                    hideCategory.show();

                    if (selectedService == 5) {
                        var selectBet = $('select[name="bet"]');

                        hideBet.show();
                        hideRacket.hide();
                        hideRentRacket.hide();

                        function updateRentBet() {
                            var selectBetValue = selectBet.val();

                            if (selectBetValue === 'Ya') {
                                hideRentBet.show();
                                
                                prices.forEach(function(price) {
                                    if (price.service_id == selectedService) {
                                        rentBet = price.price
    
                                        $('.rent_bet').text('Rp ' + Math.round(rentBet).toLocaleString('id-ID'));
                                        $('input[name="rent_bet"]').val(rentBet);
                                    }
                                }); 
                            } else {
                                hideRentBet.hide();
                                $('input[name="rent_bet"]').val('');
                            }
                        }

                        selectBet.on('change', updateRentBet);

                        updateRentBet();
                    } else if (selectedService == 6) {
                        var selectRacket = $('select[name="racket"]');

                        hideBet.hide();
                        hideRentBet.hide();
                        hideRacket.show();

                        function updateRentRacket() {
                            var selectRacketValue = selectRacket.val();

                            if (selectRacketValue === 'Ya') {
                                hideRentRacket.show();
                                
                                prices.forEach(function(price) {
                                    if (price.service_id == selectedService) {
                                        rentRacket = price.price
    
                                        $('.rent_racket').text('Rp ' + Math.round(rentRacket).toLocaleString('id-ID'));
                                        $('input[name="rent_racket"]').val(rentRacket);
                                    }
                                }); 
                            } else {
                                hideRentRacket.hide();
                                $('input[name="rent_racket"]').val('');
                            }
                        }

                        selectRacket.on('change', updateRentRacket);

                        updateRentRacket();
                    } else {
                        hideBet.hide();
                        hideRentBet.hide();
                        hideRacket.hide();
                        hideRentRacket.hide();
                    }

                    categorySelect.empty().append(
                        '<option value="">Pilih Kategori</option>' +
                        '<option value="Umum">Umum</option>' +
                        '<option value="Penghuni">Penghuni</option>'
                    );

                    categorySelect.on('change', function() {
                        var selectedValue = $(this).val();
                        
                        if (selectedValue === 'Penghuni') {
                            hideIdentity.show();
                        } else {
                            hideIdentity.hide();
                        }
                    });

                    var usageSelect = $('select[name="usage"]');
                    usageSelect.empty().append(
                        '<option value="">Pilih Lapangan</option>'
                    );

                    hideIdentity.hide();
                    hideUsage.hide();
                    hideDuration.show();
                    hidePackage.hide();
                    hideSchedule.hide();
                    hidePackageBtn.hide();
                    hideFitnessPackage.hide();
                    hideLamp.hide();
                    hideRentLights.hide();
                    hideBall.hide();
                    hideRentBall.hide();
                    $('select[name="lamp"]').val('');
                    $('input[name="rent_lights"]').val('');
                    $('select[name="ball"]').val('');
                    $('input[name="rent_ball"]').val('');
                    $('select[name="racket"]').val('');
                    $('input[name="rent_racket"]').val('');
                    $('select[name="bet"]').val('');
                    $('input[name="rent_bet"]').val('');
                } else if (selectedService == 2 || selectedService == 3 || selectedService == 4) {
                    var selectLamp = $('select[name="lamp"]');
                    var selectBall = $('select[name="ball"]');
                    var rentLights = 0;
                    
                    hideCategory.show();
                    hideLamp.show();
                    
                    function updateRentLights() {
                        var selectLampValue = selectLamp.val();

                        if (selectLampValue === 'Ya') {
                            hideRentLights.show();

                            prices.forEach(function(price) {
                                if (price.service_id == selectedService) {
                                    const validCategories = ['Lampu Lapang Basket', 'Lampu Lapang Badminton', 'Lampu Lapang Tennis'];
        
                                    const rentLight = prices.find(price => 
                                        price.service_id == selectedService && validCategories.includes(price.category)
                                    );

                                    const rentLights = rentLight ? rentLight.price : 0;
                                    
                                    $('.rent_lights').text('Rp ' + Math.round(rentLights).toLocaleString('id-ID'));
                                    $('input[name="rent_lights"]').val(rentLights);
                                }
                            });
                        } else {
                            hideRentLights.hide();
                            $('input[name="rent_lights"]').val('');
                        }
                    }

                    selectLamp.on('change', updateRentLights);

                    updateRentLights();

                    function updateRentBall() {
                        var selectBallValue = selectBall.val();

                        if (selectBallValue === 'Ya') {
                            hideRentBall.show();

                            prices.forEach(function(price) {
                                if (price.service_id == selectedService) {
                                    rentBall = ['Sewa Bola Basket'].includes(price.category) ? price.price : 0;
                                    
                                    $('.rent_ball').text('Rp ' + Math.round(rentBall).toLocaleString('id-ID'));
                                    $('input[name="rent_ball"]').val(rentBall);
                                }
                            });
                        } else {
                            hideRentBall.hide();
                            $('input[name="rent_ball"]').val('');
                        }
                    }
                    
                    selectBall.on('change', updateRentBall);
                    
                    if (selectedService == 2) {
                        hideBall.show();
                        
                        updateRentBall();
                    } else {
                        hideBall.hide();
                        hideRentBall.hide();
                    }


                    categorySelect.empty().append(
                        '<option value="">Pilih Kategori</option>' +
                        '<option value="Umum">Umum</option>' +
                        '<option value="Penghuni">Penghuni</option>'
                    );

                    categorySelect.on('change', function() {
                        var selectedValue = $(this).val();
                        
                        if (selectedValue === 'Penghuni') {
                            hideIdentity.show();
                        } else {
                            hideIdentity.hide();
                        }
                    });

                    var usageSelect = $('select[name="usage"]');
                    usageSelect.empty().append(
                        '<option value="">Pilih Lapangan</option>' +
                        '<option value="Lapang (PAGI)">Lapang (PAGI)</option>' +
                        '<option value="Lapang (SIANG)">Lapang (SIANG)</option>'
                    );

                    hideIdentity.hide();
                    hideUsage.show();
                    hideDuration.show();
                    hidePackage.hide();
                    hideSchedule.hide();
                    hidePackageBtn.hide();
                    hideFitnessPackage.hide();
                    hideRentLights.hide();
                    hideBet.hide();
                    hideRentBet.hide();
                    hideRacket.hide();
                    hideRentRacket.hide();
                    $('select[name="lamp"]').val('');
                    $('input[name="rent_lights"]').val('');
                    $('select[name="ball"]').val('');
                    $('input[name="rent_ball"]').val('');
                    $('select[name="racket"]').val('');
                    $('input[name="rent_racket"]').val('');
                    $('select[name="bet"]').val('');
                    $('input[name="rent_bet"]').val('');
                } else if (selectedService == 7) {
                    hideCategory.show();

                    categorySelect.empty().append(
                        '<option value="">Pilih Kategori</option>' +
                        '<option value="Retail Paket 1">Retail Paket 1</option>' +
                        '<option value="Retail Paket 2">Retail Paket 2</option>' +
                        '<option value="Go Fun Enjoy Fitness">Go Fun Enjoy Fitness</option>' +
                        '<option value="Go Slim & Healthy">Go Slim & Healthy</option>' +
                        '<option value="Go Strong Be Macho">Go Strong Be Macho</option>' +
                        '<option value="Private Fitness">Private Fitness</option>'
                    );

                    fitnessPackage.empty().append('<option value="">Paket</option>');

                    categorySelect.on('change', function() {
                        var selectedCategory = $(this).val();

                        fitnessPackage.empty();

                        if (selectedCategory === 'Retail Paket 1') {
                            hideFitnessPackage.show();
                            fitnessPackage.append(
                                '<option value="Fitness, Whirlpool, Steam">Fitness, Whirlpool, Steam</option>'
                            );
                        } else if (selectedCategory === 'Retail Paket 2') {
                            hideFitnessPackage.show();
                            fitnessPackage.append(
                                '<option value="Fitness, Whirlpool, Steam & Swimming">Fitness, Whirlpool, Steam & Swimming</option>'
                            );
                        } else {
                            hideFitnessPackage.hide();
                        }

                        var category = categorySelect.val();
                        var fitness = fitnessPackage.val();
                        var subtotal = 0;

                        if (category) {
                            prices.forEach(function(price) {
                                if (price.category === category) {
                                    subtotal = price.price;
                                }
                            });
                        }
    
                        updateTotal(subtotal);
                    });

                    hideIdentity.hide();
                    hideUsage.hide();
                    hideDuration.hide();
                    hidePackage.hide();
                    hideSchedule.hide();
                    hidePackageBtn.hide();
                    hideLamp.hide();
                    hideRentLights.hide();
                    hideBall.hide();
                    hideRentBall.hide();
                    hideBet.hide();
                    hideRentBet.hide();
                    hideRacket.hide();
                    hideRentRacket.hide();
                    $('select[name="lamp"]').val('');
                    $('input[name="rent_lights"]').val('');
                    $('select[name="ball"]').val('');
                    $('input[name="rent_ball"]').val('');
                    $('select[name="racket"]').val('');
                    $('input[name="rent_racket"]').val('');
                    $('select[name="bet"]').val('');
                    $('input[name="rent_bet"]').val('');
                } else {
                    hideIdentity.hide();
                    hideCategory.hide();
                    hideUsage.hide();
                    hidePackage.hide();
                    hideSchedule.hide();
                    hideDuration.hide();
                    hidePackageBtn.hide();
                    hideFitnessPackage.hide();
                    hideLamp.hide();
                    hideRentLights.hide();
                    hideBall.hide();
                    hideRentBall.hide();
                    hideBet.hide();
                    hideRentBet.hide();
                    hideRacket.hide();
                    hideRentRacket.hide();
                    $('select[name="lamp"]').val('');
                    $('input[name="rent_lights"]').val('');
                    $('select[name="ball"]').val('');
                    $('input[name="rent_ball"]').val('');
                    $('select[name="racket"]').val('');
                    $('input[name="rent_racket"]').val('');
                    $('select[name="bet"]').val('');
                    $('input[name="rent_bet"]').val('');
                }
            });

            $('input[name="datetime"], input[name="dewasa"], input[name="anak"], input[name="pengantar"], input[name="buku"], #minusDewasa, #plusDewasa, #minusAnak, #plusAnak, #minusPengantar, #plusPengantar, #minusBuku, #plusBuku').on('input click', function() {
                var schedule = $('select[name="scheduleOption"]').val();
                var dewasa = $('input[name="dewasa"]').val();
                var anak = $('input[name="anak"]').val();
                var pengantar = $('input[name="pengantar"]').val();
                var buku = $('input[name="buku"]').val();
                var subtotal = 0;

                prices.forEach(function(price) {
                    if (dewasa != 0 && price.package == "Dewasa") {
                        if (schedule === "Weekday") {
                            subtotal += price.weekday * dewasa;
                        } else if (schedule === "Weekend") {
                            subtotal += price.weekend * dewasa;
                        }
                    } else if (anak != 0 && price.package == "Anak") {
                        if (schedule === "Weekday") {
                            subtotal += price.weekday * anak;
                        } else if (schedule === "Weekend") {
                            subtotal += price.weekend * anak;
                        }
                    } else if (pengantar != 0 && price.package == "Pengantar") {
                        if (schedule === "Weekday") {
                            subtotal += price.weekday * pengantar;
                        } else if (schedule === "Weekend") {
                            subtotal += price.weekend * pengantar;
                        }
                    } else if (buku != 0 && price.package == "Tiket Buku (15 Lembar)") {
                        if (schedule === "Weekday") {
                            subtotal += price.weekday * buku;
                        } else if (schedule === "Weekend") {
                            subtotal += price.weekend * buku;
                        }
                    } else if (dewasa != 0 && price.package == "Dewasa" && anak != 0 && price.package == "Anak") {
                        if (schedule === "Weekday") {
                            subtotalDewasa += price.weekday * dewasa;
                            subtotalAnak += price.weekday * anak;
                            subtotal += subtotalDewasa + subtotalAnak;
                        } else if (schedule === "Weekend") {
                            subtotalDewasa += price.weekend * dewasa;
                            subtotalAnak += price.weekend * anak;
                            subtotal += subtotalDewasa + subtotalAnak;
                        }
                    } else if (dewasa != 0 && price.package == "Dewasa" && anak != 0 && price.package == "Anak" && pengantar != 0 && price.package == "Pengantar") {
                        if (schedule === "Weekday") {
                            subtotalDewasa += price.weekday * dewasa;
                            subtotalAnak += price.weekday * anak;
                            subtotalPengantar += price.weekday * pengantar;
                            subtotal += subtotalDewasa + subtotalAnak + subtotalPengantar;
                        } else if (schedule === "Weekend") {
                            subtotalDewasa += price.weekend * dewasa;
                            subtotalAnak += price.weekend * anak;
                            subtotalPengantar += price.weekend * pengantar;
                            subtotal += subtotalDewasa + subtotalAnak + subtotalPengantar;
                        }
                    }  else if (dewasa != 0 && price.package == "Dewasa" && anak != 0 && price.package == "Anak" && pengantar != 0 && price.package == "Pengantar" && buku != 0 && price.package == "Tiket Buku (15 Lembar)") {
                        if (schedule === "Weekday") {
                            subtotalDewasa += price.weekday * dewasa;
                            subtotalAnak += price.weekday * anak;
                            subtotalPengantar += price.weekday * pengantar;
                            subtotalBuku += price.weekday * buku;
                            subtotal += subtotalDewasa + subtotalAnak + subtotalPengantar + subtotalBuku;
                        } else if (schedule === "Weekend") {
                            subtotalDewasa += price.weekend * dewasa;
                            subtotalAnak += price.weekend * anak;
                            subtotalPengantar += price.weekend * pengantar;
                            subtotalBuku += price.weekend * buku;
                            subtotal += subtotalDewasa + subtotalAnak + subtotalPengantar + subtotalBuku;
                        }
                    }
                });

                updateTotal(subtotal);
            });

            $('select[name="service"], select[name="category"], select[name="usage"], select[name="duration"]').change(function () {
                var service = $('select[name="service"]').val();
                var category = $('select[name="category"]').val();
                var duration = $('select[name="duration"]').val();
                var usage = $('select[name="usage"]').val();
                var durationValue = parseInt(duration);
                var subtotal = 0;
    
                if (isNaN(durationValue)) {
                    durationValue = 0;
                }
    
                prices.forEach(function(price) {
                    if (price.service_id == service) {
                        if (price.category == category) {
                            if (usage == 'Lapang (PAGI)') {
                                subtotal = durationValue * price.morning;
                            } else if (usage == 'Lapang (SIANG)') {
                                subtotal = durationValue * price.afternoon;
                            } else if (usage == '') {
                                subtotal = durationValue * price.price;
                            }
                        }
                    }
                });
    
                updateTotal(subtotal);
            });

            function updateTotal(subtotal) {
                subtotal = Math.round(subtotal) || 0;

                const updateRentValues = () => {
                    return {
                        rentLights: Math.round($('input[name="rent_lights"]').val()) || 0,
                        rentBall: Math.round($('input[name="rent_ball"]').val()) || 0,
                        rentRacket: Math.round($('input[name="rent_racket"]').val()) || 0,
                        rentBet: Math.round($('input[name="rent_bet"]').val()) || 0
                    };
                };

                function calculateTotal(subtotal, rentValues) {
                    const { rentLights, rentBall, rentRacket, rentBet } = rentValues;
                    const calculate = subtotal + rentLights + rentBall + rentRacket + rentBet;
                    const ppn = (calculate * {{ $setting->ppn }}) / 100;
                    const total = calculate + ppn;

                    $('.subtotal').text('Rp ' + subtotal.toLocaleString('id-ID'));
                    $('input[name="subtotal"]').val(subtotal);

                    $('.ppn').text('Rp ' + Math.round(ppn).toLocaleString('id-ID'));
                    $('input[name="ppn"]').val(ppn);

                    $('.total').text('Rp ' + Math.round(total).toLocaleString('id-ID'));
                    $('input[name="total"]').val(total);
                }

                $('select[name="service"], select[name="lamp"], select[name="ball"], select[name="racket"], select[name="bet"]').change(function() {
                    if ($(this).attr('name') === 'service') {
                        subtotal = 0;
                    }

                    calculateTotal(subtotal, updateRentValues());
                });

                calculateTotal(subtotal, updateRentValues());
            }
        });
    </script>
@endsection
