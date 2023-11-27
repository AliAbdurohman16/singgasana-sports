@component('mail::message')

<h1 class="text-center mb-4">Invoice Booking Harian</h1>
<div class="row">
    <div class="col-12">
        <h2 class="mt-4 mb-2">Booking ID : <b>{{ $data->id }}</b></h2>
        <div class="dashed mb-2"></div>
        <div class="row mb-2">
            <div class="col-4"><b>Nama Lengkap</b></div>
            <div class="col-8">{{ $data->first_name }} {{ $data->last_name }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-4"><b>Layanan</b></div>
            <div class="col-8">{{ $data->service->name }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-4"><b>Tanggal Mulai</b></div>
            <div class="col-8">{{ date('d-m-Y', strtotime($data->datetime)) }}</div>
        </div>
        @if (!is_null($data->duration))
        <div class="row mb-2">
            <div class="col-4"><b>Durasi</b></div>
            <div class="col-8">{{ $data->duration }}</div>
        </div>
        @endif
        <div class="dashed mb-2"></div>
        <div class="row mb-2">
            <div class="col-4"><b>Pembayaran :</b></div>
            <div class="col-8"><b>Cash</b></div>
        </div>
        <div class="row mb-2">
            <div class="col-4"><b>Total Payment :</b></div>
            <div class="col-8 total">Rp {{ number_format($data->total, 0, ',', '.') }}</div>
        </div>
        <div class="dashed mb-2 mt-2"></div>
        <div class="foot">1. Silahkan lakukan pembayaran ke kasir</div>
        <div class="foot">2. Serahkan invoice ini ke kasir untuk divalidasi pembayarannya</div>
        <div class="foot">3. Invoice ini akan berakhir pada {{ date('d-m-Y H:i:s', strtotime($data->expired)) }}</div>
    </div>
</div>
@endcomponent
