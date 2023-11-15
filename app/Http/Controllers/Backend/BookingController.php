<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BookingDaily;
use App\Models\BookingMember;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\ValidationBookingDailyMail;
use App\Mail\ValidationBookingMemberMail;

class BookingController extends Controller
{
    public function index()
    {
        $histories = BookingMember::orderBy('status', 'asc')->get();

        return view('backend.booking.histories.index', compact('histories'));
    }

    public function daily()
    {
        $dailies = BookingDaily::orderBy('status', 'asc')->get();

        return view('backend.booking.dailies.index', compact('dailies'));
    }

    public function validationDaily(Request $request, $id)
    {
        $daily = BookingDaily::where('id', $id)->first();

        // Generate a 6-Digit PIN
        $pin = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Generate QR Code
        $qrCode = QrCode::size(100)->generate($pin);
        $qrCodePath = 'qr_codes/' . $daily->id . '_qr.png'; // Path to save the QR code

        // Save QR code image to the public directory
        Storage::disk('public')->put($qrCodePath, $qrCode);

        $daily->update([
            'pin' => $pin,
            'qr' => asset($qrCodePath),
            'status' => 'success',
        ]);

        Mail::to($daily->email)->send(new ValidationBookingDailyMail($daily));

        return response()->json(['message' => 'Data berhasil divalidasi!']);
    }

    public function showDaily($id)
    {
        $daily = BookingDaily::where('id', $id)->first();

        return view('backend.booking.dailies.detail', compact('daily'));
    }

    public function member()
    {
        $members = BookingMember::orderBy('status', 'asc')->get();

        return view('backend.booking.members.index', compact('members'));
    }

    public function validationMember(Request $request, $id)
    {
        //
    }

    public function memberStore(Request $request)
    {
        //
    }
}
