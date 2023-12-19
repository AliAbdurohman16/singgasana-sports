<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PriceDaily;
use App\Models\PriceMember;
use App\Models\Service;
use App\Models\BookingDaily;
use App\Models\BookingMember;
use App\Models\BookingSchool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\InvoiceBookingDailyMail;
use App\Mail\InvoiceBookingMemberMail;
use App\Mail\InvoiceBookingSchoolMail;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $data = [
            'services' => Service::all(),
            'prices' => PriceDaily::all(),
        ];

        return view('frontend.booking.daily.index', $data);
    }

    public function store(Request $request)
    {
        $service = $request->service;
        $datetime = $request->datetime;
        $category = $request->category;

        if ($service == 1) {
            $information = $request->package;
            $time = $request->schedule;
        } else if ($service == 5 || $service == 6) {
            $information = $category;
            $time = $request->duration;
        } else {
            $information = $category."(".$request->usage.")";
            $time = $request->duration;
        }

        $expired = Carbon::parse($datetime)->addDay();

        $data = BookingDaily::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'service_id' => $service,
            'datetime' => $datetime,
            'information' => $information,
            'duration' => $time,
            'total' => $request->total,
            'expired' => $expired,
        ]);

        Mail::to($request->email)->send(new InvoiceBookingDailyMail($data));
        return redirect('booking/daily')->with('message', 'Booking berhasil! Mohon periksa email yang telah Anda daftarkan pada formulir yang tadi diisi.');
    }

    public function member()
    {
        $data = [
            'services' => Service::all(),
            'prices' => PriceMember::all(),
        ];

        return view('frontend.booking.member.index', $data);
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
        $school = $request->school;
        $student = $request->student;
        $total = $request->total;

        if ($total == 0) {
            return redirect('booking/member')->with('error', 'Booking gagal! Silahkan lengkapi form isian tersebut.');
        }

        if (empty($datetime)) {
            return redirect('booking/member')->with('error', 'Booking gagal! Tanggal Mulai wajib diisi!.');
        }

        if (!empty($school)) {
            $package = 'Sekolah';
        } else {
            $package = $request->package;
        }

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
            "Sekolah" => 1,
        ];

        $duration = $packageExpiration[$package];

        if (is_numeric($duration)) {
            $expired = Carbon::parse($datetime)->addMonths($duration);
        } elseif ($duration === "week") {
            $expired = Carbon::parse($datetime)->addWeeks();
        } elseif (is_numeric($duration)) {
            $expired = Carbon::parse($datetime)->addHours($duration);
        } else {
            $expired = Carbon::parse($datetime)->addMonths(1);
        }

        $existingBooking = BookingMember::where('school', $school)
                            ->where('status', 'Pending')
                            ->first();

        if ($existingBooking) {
            $existingBooking->total += $total;
            $existingBooking->save();
            $data = $existingBooking;
        } else {
            $data = BookingMember::create([
                'user_id' => $user->id,
                'service_id' => $request->service,
                'datetime' => $datetime,
                'package' => $package,
                'school' => $school,
                'total' => $total,
                'expired' => $expired,
            ]);
        }

        if (!empty($student)) {
            $bookingSchool = BookingSchool::create([
                'booking_member_id' => $data->id,
                'student_counts' => $student,
                'lock' => $student,
                'subtotal' => $total,
            ]);

            Mail::to($user->email)->send(new InvoiceBookingSchoolMail($bookingSchool));
        } else {
            Mail::to($user->email)->send(new InvoiceBookingMemberMail($data));
        }

        return redirect('booking/member')->with('message', 'Booking berhasil! Mohon periksa email yang telah terdaftar.');
    }

    public function schedule()
    {
        $schedules = BookingDaily::select('booking_dailies.*', 'services.name as service_name')
                        ->join('services', 'booking_dailies.service_id', '=', 'services.id')
                        ->get();

        return view('frontend.schedule.index', compact('schedules'));
    }
}
