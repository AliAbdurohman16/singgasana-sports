@component('mail::message')

<img src="{{ asset('icon/checked.png') }}" alt="Circle Check" style="display:block;margin:auto;margin-bottom:20px;text-align:center;width:100px;">
<h1 class="text-center mb-4">Invoice Booking Harian</h1>
<div class="row">
    <div class="col-12">
        <h2 class="mt-4 mb-2">Booking ID : <b>{{ $data['id'] }}</b></h2>
        <div class="dashed mb-2"></div>
        <div class="row mb-2">
            <div class="col-4"><b>Nama Lengkap</b></div>
            <div class="col-8">{{ $data['first_name'] }} {{ $data['last_name'] }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-4"><b>Layanan</b></div>
            <div class="col-8">{{ $data['service'] }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-4"><b>Tanggal Dibooking</b></div>
            <div class="col-8">{{ date('d-m-Y H:i:s', strtotime($data['datetime'])) }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-4"><b>Durasi</b></div>
            <div class="col-8">{{ $data['duration'] }}</div>
        </div>
        <div class="dashed mb-2"></div>
        <div class="row mb-2">
            <div class="col-4"><b>Pembayaran :</b></div>
            <div class="col-8"><b>Cash</b></div>
        </div>
        <div class="row mb-2">
            <div class="col-4"><b>Total Payment :</b></div>
            <div class="col-8 total">Rp 160.000</div>
        </div>
        <div class="dashed mb-2 mt-2"></div>
        <div class="foot">1. Silahkan lakukan pembayaran ke kasir</div>
        <div class="foot">2. Serahkan invoice ini ke kasir untuk divalidasi pembayarannya</div>
    </div>
</div>
@endcomponent
