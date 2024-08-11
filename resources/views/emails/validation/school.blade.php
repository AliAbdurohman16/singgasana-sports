@component('mail::message')
<img src="{{ asset('singgasana-sport/public/icon/checked.png') }}" alt="Circle Check" class="img-fluid" style="display:block;margin:auto;margin-bottom:20px;text-align:center;width:50px;">
<h1 class="text-center mb-4">Validasi Berhasil</h1>
<div class="row mb-2"><div class="col-12">Halo {{ $data->user->first_name }},</div></div>
<div class="row mb-2"><div class="col-12">Kami senang memberitahu Anda bahwa proses validasi Anda baru-baru ini berhasil.</div></div>
<!-- {{-- @component('mail::button', ['url' => asset('qr_codes/' . $data->qr), 'color' => 'primary'])
Unduh QR Code
@endcomponent --}}
{{-- <div class="row mb-2"><div class="col-12">Harap simpan QR ini dengan kerahasiaan dan gunakan untuk tiket Anda.</div></div> -->
<div class="row mb-2"><div class="col-12">Harap diingat bahwa kode QR ini akan berlaku hingga <b>{{ date('d-m-Y H:i:s', strtotime($data->expired)) }}</b>. Setelah waktu tersebut, kode ini akan tidak berlaku dan Anda perlu melakukan proses booking kembali.</div></div> --}}
<div class="row mb-2"><div class="col-12">Jika Anda memiliki pertanyaan atau kekhawatiran, jangan ragu untuk menghubungi tim dukungan kami.</div></div>
<div class="row mb-4"><div class="col-12">Terima kasih telah memilih layanan kami!</div></div>
<div class="row mb-2"><div class="col-12">Salam Hangat,</div></div>
<div class="row mb-2"><div class="col-12">Singgasana Sports and Recreation Centre</div></div>
@endcomponent
