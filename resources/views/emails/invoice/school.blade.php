@component('mail::message')

<h1 class="text-center mb-4">Invoice Booking Sekolah</h1>
<div class="row">
    <div class="col-12">
        <h2 class="mt-4 mb-2">Booking ID : <b>{{ $data->bookingMember->id }}</b></h2>
        <div class="dashed mb-2"></div>
        <div class="row mb-2">
            <div class="col-4"><b>Nama Lengkap</b></div>
            <div class="col-8">{{ $data->bookingMember->user->first_name }} {{ $data->bookingMember->user->last_name }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-4"><b>Layanan</b></div>
            <div class="col-8">{{ $data->bookingMember->service->name }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-4"><b>Nama Sekolah</b></div>
            <div class="col-8">{{ $data->bookingMember->school }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-4"><b>Jumlah Siswa</b></div>
            <div class="col-8">{{ $data->student_counts }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-4"><b>Tanggal Mulai</b></div>
            <div class="col-8">{{ date('d-m-Y H:i:s', strtotime($data->start_date)) }}</div>
        </div>
        <div class="dashed mb-2"></div>
        <div class="row mb-2">
            <div class="col-4"><b>Pembayaran :</b></div>
            <div class="col-8"><b>Tagihan diakhir bulan</b></div>
        </div>
        <div class="row mb-2">
            <div class="col-4"><b>Total Payment :</b></div>
            <div class="col-8 total">Rp {{ number_format($data->subtotal, 0, ',', '.') }}</div>
        </div>
        <div class="dashed mb-2"></div>
        <div class="row mb-2">
            <div class="col-4"><b>Transfer :</b></div>
            <div class="col-8 total"><b>45333 20328 (BCA)</b></div>
        </div>
        <div class="row mb-2">
            <div class="col-4"><b></b></div>
            <div class="col-8"><b>a/n PT. Singgasana Sarana Sejahtera</b></div>
        </div>
        <div class="dashed mb-2 mt-2"></div>
        <div class="foot">1. Pembayaran dapat dilakukan secara transfer</div>
        <div class="foot">2. Silahkan kirimkan bukti pembayaran ke nomor telepon 087737268080</div>>
        <div class="foot">3. Apabila terjadi pembatalan transaksi, uang yang sudah diserahkan tidak dapat dikembalikan</div>
    </div>
</div>
@endcomponent
