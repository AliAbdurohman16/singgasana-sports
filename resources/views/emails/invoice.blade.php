@component('mail::message')

<img src="{{ asset('icon/checked.png') }}" alt="Circle Check" style="display:block;margin:auto;margin-bottom:20px;text-align:center;width:100px;">
<h1 class="text-center mb-4">Booking Payment Success</h1>
<div class="row">
    <div class="col-12">
        <h2 class="mt-4 mb-2">Order ID : <b>ORD20293092030</b></h2>
        <div class="dashed mb-2"></div>
        <div class="row mb-2">
            <div class="col-4"><b>City</b></div>
            <div class="col-8">Jakarta</div>
        </div>
        <div class="row mb-2">
            <div class="col-4"><b>From</b></div>
            <div class="col-8">HR Rasuna Said</div>
        </div>
        <div class="row mb-2">
            <div class="col-4"><b>Route</b></div>
            <div class="col-8">HR Rasuna Said - Dipati Ukur</div>
        </div>
        <div class="dashed mb-2"></div>
        <div class="row mb-2">
            <div class="col-4"><b>Total Payment :</b></div>
            <div class="col-8 total">Rp 160.000</div>
        </div>
        <div class="dashed mb-2"></div>
        <div class="row mb-2">
            <div class="col-4"><img src="{{ asset('icon/calendar.png') }}" alt="Date" style="width:14px;"> Date</div>
            <div class="col-8">12-05-2023</div>
        </div>
        <div class="row mb-2">
            <div class="col-4"><img src="{{ asset('icon/clock.png') }}" alt="Time" style="width:14px;"> Time</div>
            <div class="col-8">15:45:00</div>
        </div>
        <div class="row mb-2">
            <div class="col-4"><img src="{{ asset('icon/house.png') }}" alt="Room" style="width:14px;"> Room(s) Number</div>
            <div class="col-8">15</div>
        </div>
        <div class="dashed mb-2"></div>
        <b>Pembayaran :</b>
        <div class="row">
            <div class="col-4">Metode</div>
            <div class="col-8"><b>Permata Virtual Account</b><br>Pay with Permata VA</div>
        </div>
        <div class="dashed mb-2 mt-2"></div>
        <div class="foot">1. Present E-Ticket at Singgasana Sport & Recreation Centre for Check In</div>
        <div class="foot">2. Check In at least 30 minutes prior to departure</div>
    </div>
</div>
@endcomponent
