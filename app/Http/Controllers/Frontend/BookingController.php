<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Memberships;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;

class BookingController extends Controller
{
    public function index()
    {
        return view('frontend.booking.index');
    }

    public function store(Request $request)
    {
        $booking = $request->validate([
            'nama_lengkap' => 'required',
            'tipe_membership' => 'required',
            'email' => 'required|email:dns',
            'notelp' => 'required|numeric',
            'booking_until' => 'required',
            'alamat' => 'required'
        ]);

        Memberships::create($booking);
        $data = [
            'order_id' => 'ORD20293092030',
            // Insert other data here
        ];
        Mail::to($request->email)->send(new InvoiceMail($data));
        return redirect('booking')->with('message', 'Data Berhasil Dikirim. Silahkan Lihat Email Konfirmasi');
    }

}
