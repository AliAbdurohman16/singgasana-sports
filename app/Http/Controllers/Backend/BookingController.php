<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BookingDaily;
use App\Models\BookingMember;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\ValidationBookingDailyMail;
use App\Mail\ValidationBookingMemberMail;
use App\Mail\InvoiceBookingMemberMail;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $histories = BookingMember::where('user_id', Auth::user()->id)
                        ->orderBy('status', 'asc')
                        ->get();

        return view('backend.booking.histories.index', compact('histories'));
    }

    public function create()
    {
        $services = Service::all();

        return view('backend.booking.create', compact('services'));
    }

    public function store(Request $request)
    {
        // get the currently logged in user
        $user = Auth::user();

        // if the user is not logged in, redirect to the login page
        if (!$user) {
            return redirect('login');
        }

        $datetime = $request->datetime;

        $expired = Carbon::parse($datetime)->addHours(intval($request->duration));

        $data = BookingMember::create([
            'user_id' => $user->id,
            'service_id' => $request->service,
            'datetime' => $datetime,
            'duration' => $request->duration,
            'total' => $request->total,
            'expired' => $expired,
        ]);

        Mail::to($user->email)->send(new InvoiceBookingMemberMail($data));
        return redirect('booking/create')->with('message', 'Booking berhasil! Mohon periksa email yang telah terdaftar.');
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
        $qr = QrCode::size(100)->generate($pin);

        // Save QR Code as PNG
        $qrPath = public_path('qr_codes/'); // Folder to save QR codes
        $qrFileName = 'qr_' . time() . '.png'; // Generate a unique file name

        // Save QR code as PNG
        QrCode::size(300)->format('png')->generate($pin, $qrPath . $qrFileName);

        $daily->update([
            'pin' => $pin,
            'qr' => $qrFileName,
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
        $member = BookingMember::where('id', $id)->first();

        // Generate a 6-Digit PIN
        $pin = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Generate QR Code
        $qr = QrCode::size(100)->generate($pin);

        // Save QR Code as PNG
        $qrPath = public_path('qr_codes/'); // Folder to save QR codes
        $qrFileName = 'qr_' . time() . '.png'; // Generate a unique file name

        // Save QR code as PNG
        QrCode::size(300)->format('png')->generate($pin, $qrPath . $qrFileName);

        $member->update([
            'pin' => $pin,
            'qr' => $qrFileName,
            'status' => 'success',
        ]);

        Mail::to($member->user->email)->send(new ValidationBookingMemberMail($member));

        return response()->json(['message' => 'Data berhasil divalidasi!']);
    }

    public function showMember($id)
    {
        $member = BookingMember::where('id', $id)->first();

        return view('backend.booking.members.detail', compact('member'));
    }
}
