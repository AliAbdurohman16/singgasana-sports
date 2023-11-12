<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Schedule;
use App\Models\BookingDaily;
use App\Models\BookingMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\InvoiceBookingDailyMail;
use App\Mail\InvoiceBookingMemberMail;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $services = Service::all();

        return view('frontend.booking.daily.index', compact('services'));
    }

    public function store(Request $request)
    {
        $service = $request->service;
        $datetime = $request->datetime;

        $expired = ($service == 'Swimming Pool')
                    ? Carbon::parse($datetime)->addDay()
                    : Carbon::parse($datetime)->addHours(intval($request->duration));

        if ($service != 'Swimming Pool') {
            // Check if there is an existing booking with the same service and overlapping datetime-expired range
            $existingBooking = BookingDaily::where('service', $service)
                ->where(function ($query) use ($datetime, $expired) {
                    $query->whereBetween('datetime', [$datetime, $expired])
                        ->orWhereBetween('expired', [$datetime, $expired]);
                })->count();

            if ($existingBooking >= 4) {
                // If there are already 4 bookings, return a failure message
                return redirect('booking/daily')->with('error', 'Maaf, sudah mencapai batas maksimal booking untuk jam tersebut.');
            }
        }

        $data = BookingDaily::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'service' => $service,
            'datetime' => $datetime,
            'duration' => $request->duration,
            'total' => $request->total,
            'expired' => $expired,
        ]);

        Mail::to($request->email)->send(new InvoiceBookingDailyMail($data));
        return redirect('booking/daily')->with('message', 'Booking berhasil! Mohon periksa email yang telah Anda daftarkan pada formulir yang tadi diisi.');
    }

    public function member()
    {
        $services = Service::all();

        return view('frontend.booking.member.index', compact('services'));
    }

    public function storeMember(Request $request)
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
        return redirect('booking/member')->with('message', 'Booking berhasil! Mohon periksa email yang telah Anda daftarkan pada formulir yang tadi diisi.');
    }

    public function schedule()
    {
        return view('frontend.schedule.index');
    }
}
