<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BookingDaily;
use App\Models\BookingMember;
use App\Models\PriceMember;
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
        $data = [
            'services' => Service::all(),
            'prices' => PriceMember::all(),
        ];

        return view('backend.booking.create', $data);
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

        $package = $request->package;

        // Array asosiasi antara nama paket dan periode kedaluwarsa
        $packageExpiration = [
            "Iuran Membership 2 Bulan" => 2,
            "Iuran Membership 6 Bulan" => 6,
            "Iuran Membership 12 Bulan" => 12,
            "Paket A - Pemula" => "week",
            "Paket B - Prestasi Non Fitness" => "week",
            "Paket C - Prestasi + Fitness" => "week",
            "Paket D - Pra Prestasi" => "week",
            "Iuran Membership 2 Bulan (5 Orang)" => 2,
            "Iuran Membership 6 Bulan (5 Orang)" => 6,
            "Iuran Membership Pelatih Club 2 Bulan" => 2,
            "Iuran Membership Pelatih Club + Fitness 2 Bulan" => 2,
            "Per 2 Jam 1x Seminggu (PAGI)" => "week",
            "Per 3 Jam 1x Seminggu (PAGI)" => "week",
            "Per 2 Jam 1x Seminggu (SIANG)" => "week",
            "Per 4 Jam 1x Seminggu (SIANG)" => "week",
            "Per 3 Jam 1x Seminggu (SIANG)" => "week",
            "Per 1 Jam 1x Seminggu" => "week",
            "Per 2 Jam 1x Seminggu" => "week",
            "Per 3 Jam 1x Seminggu" => "week",
            "Paket Suka - Suka 10 Jam" => 10,
            "Paket Suka - Suka 12 Jam" => 12,
            "Paket Suka - Suka 15 Jam" => 15,
        ];

        $duration = $packageExpiration[$package];

        if (is_numeric($duration)) {
            $expired = Carbon::parse($datetime)->addMonths($duration);
        } elseif ($duration === "week") {
            $expired = Carbon::parse($datetime)->addWeeks();
        } elseif (is_numeric($duration)) {
            $expired = Carbon::parse($datetime)->addHours($duration);
        }

        $data = BookingMember::create([
            'user_id' => $user->id,
            'service_id' => $request->service,
            'datetime' => $datetime,
            'package' => $package,
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

        // Save QR Code as pdf
        $qrPath = public_path('qr_codes/'); // Folder to save QR codes
        $qrFileName = 'qr_' . time() . '.pdf'; // Generate a unique file name

        // Save QR code as pdf
        QrCode::size(300)->format('pdf')->backgroundColor(255, 255, 255)->margin(20)->generate($pin, $qrPath . $qrFileName);

        $expired = ($daily->service_id == 1)
                    ? Carbon::parse($daily->datetime)->addDay()
                    : Carbon::parse($daily->datetime)->addHours(intval($daily->duration));

        $daily->update([
            'expired' => $expired,
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

        // Save QR Code as pdf
        $qrPath = public_path('qr_codes/'); // Folder to save QR codes
        $qrFileName = 'qr_' . time() . '.pdf'; // Generate a unique file name

        // Save QR code as pdf
        QrCode::size(300)->format('pdf')->backgroundColor(255, 255, 255)->margin(20)->generate($pin, $qrPath . $qrFileName);

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
