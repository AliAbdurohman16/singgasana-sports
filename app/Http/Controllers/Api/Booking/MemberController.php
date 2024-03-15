<?php

namespace App\Http\Controllers\Api\Booking;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PriceMember;
use App\Models\Service;
use App\Models\BookingMember;
use App\Models\BookingSchool;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\InvoiceBookingMemberMail;
use App\Mail\InvoiceBookingSchoolMail;
use App\Helpers\ResponseFormatter;

class MemberController extends Controller
{
    public function store(Request $request)
    {
        // get the currently logged in user
        $user = Auth::user();

        // if the user is not logged in, return unauthorized response
        if (!$user) {
            return ResponseFormatter::error('Unauthorized', 'Unauthorized', 401);
        }

        $datetime = $request->datetime;
        $school = $request->school;
        $student = $request->student;
        $total = $request->total;

        if ($total == 0) {
            return ResponseFormatter::error(null, 'Booking gagal! Silahkan lengkapi form isian tersebut.', 422);
        }

        if (empty($datetime)) {
            return ResponseFormatter::error(null, 'Booking gagal! Tanggal Mulai wajib diisi!.', 422);
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
                            ->whereNotNull('school')
                            ->where('status', 'Pending')
                            ->first();

        if (!$existingBooking) {
            $data = BookingMember::create([
                'user_id' => $user->id,
                'service_id' => $request->service,
                'datetime' => $datetime,
                'package' => $package,
                'school' => $school,
                'total' => $total,
                'expired' => $expired,
                'app_name' => 'mobile',
            ]);
        } else {
            $existingBooking->total += $total;
            $existingBooking->save();
            $data = $existingBooking;
        }

        if (!empty($student)) {
            $bookingSchool = BookingSchool::create([
                'booking_member_id' => $data->id,
                'start_date' => $datetime,
                'student_counts' => $student,
                'lock' => $student,
                'subtotal' => $total,
            ]);

            Mail::to($user->email)->send(new InvoiceBookingSchoolMail($bookingSchool));

            return ResponseFormatter::success(['booking_school' => $bookingSchool], 'Booking berhasil! Mohon periksa email yang telah terdaftar.');
        } else {
            Mail::to($user->email)->send(new InvoiceBookingMemberMail($data));

            return ResponseFormatter::success(['booking_member' => $data], 'Booking berhasil! Mohon periksa email yang telah terdaftar.');
        }
    }
}
