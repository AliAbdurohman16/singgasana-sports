@component('mail::message')

<h1 class="text-center mb-4">Invoice Booking Sekolah</h1>
<div class="row">
    <div class="col-12">
        <h2 class="mt-4 mb-2">Booking ID : <b>{{ $data->id }}</b></h2>
        <div class="dashed mb-2"></div>
        <div class="row mb-2">
            <div class="col-4"><b>Nama Lengkap</b></div>
            <div class="col-8">{{ $data->user->first_name }} {{ $data->user->last_name }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-4"><b>Layanan</b></div>
            <div class="col-8">{{ $data->service->name }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-4"><b>Nama Sekolah</b></div>
            <div class="col-8">{{ $data->school }}</div>
        </div>
        <div class="dashed mb-2"></div>
        <div class="row mb-2">
            <div class="col-4"><b>Total Payment :</b></div>
            <div class="col-8 total">Rp {{ number_format($data->total, 0, ',', '.') }}</div>
        </div>
        <div class="dashed mb-2 mt-2"></div>
        <div class="foot">1. Invoice ini berisi total biaya untuk pesanan yang telah dipesan.</div>
        <div class="foot">2. Silahkan lakukan pembayaran ke kasir</div>
        <div class="foot">3. Serahkan invoice ini ke kasir untuk divalidasi pembayarannya</div>
    </div>
</div>
@endcomponent
