<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PriceDaily;
use App\Models\PriceMember;
use App\Models\Service;
use App\Models\BookingDaily;
use App\Models\BookingDailyDetail;
use App\Models\BookingMember;
use App\Models\BookingSchool;
use App\Models\Setting;
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
            'setting' => Setting::find(1),
        ];

        return view('frontend.booking.daily.index', $data);
    }

    public function store(Request $request)
    {
        $service = $request->service;
        $datetime = $request->datetime;
        $category = $request->category;
        $dewasa = $request->dewasa;
        $anak = $request->anak;
        $pengantar = $request->pengantar;
        $buku = $request->buku;
        $identity = $request->identity;
        $subtotal = $request->subtotal;
        $total = $request->total;

        // Define operational hours
        $dayOfWeek = Carbon::parse($datetime)->dayOfWeek;
        $operationalHours = [
            1 => ['start' => '14:00', 'end' => '21:00'], // Monday
            2 => ['start' => '06:00', 'end' => '21:00'], // Tuesday
            3 => ['start' => '06:00', 'end' => '21:00'], // Wednesday
            4 => ['start' => '06:00', 'end' => '21:00'], // Thursday
            5 => ['start' => '06:00', 'end' => '21:00'], // Friday
            6 => ['start' => '06:00', 'end' => '21:00'], // Saturday
            0 => ['start' => '06:00', 'end' => '21:00'], // Sunday
        ];

        if ($service != 1) {
            // Adjust operational hours for service != 1
            $operationalHours = array_fill(0, 7, ['start' => '06:00', 'end' => '22:00']);
        }

        // Get operational hours for the current day
        $start = $operationalHours[$dayOfWeek]['start'];
        $end = $operationalHours[$dayOfWeek]['end'];
        
        // Create Carbon instances for start and end of the operational hours
        $startOfDay = Carbon::parse($datetime)->setTimeFromTimeString($start);
        $endOfDay = Carbon::parse($datetime)->setTimeFromTimeString($end);
        
        // Check if the datetime is within operational hours
        if (!Carbon::parse($datetime)->between($startOfDay, $endOfDay)) {
            return redirect('booking/daily')->with('error', 'Booking gagal! Waktu yang dipilih berada di luar jam operasional.');
        }
        
        if ($category === 'Penghuni') {
            if (empty($identity)) {
                return redirect('booking/daily')->with('error', 'Booking gagal! Silahkan isi bukti identitas terlebih dahulu.');
            }
        }

        if ($total == 0) {
            return redirect('booking/daily')->with('error', 'Booking gagal! Silahkan lengkapi form isian tersebut.');
        }

        if (empty($datetime)) {
            return redirect('booking/daily')->with('error', 'Booking gagal! Tanggal Mulai wajib diisi!.');
        }

        $expired_payment = Carbon::now()->addMinutes(20)->toDateTimeString();

        $expired_biometrik = $service == 1
                            ? Carbon::parse($datetime)->addHours(24)->endOfDay()
                            : Carbon::parse($datetime)->addHours(intval($request->duration))->min(Carbon::parse($datetime)->endOfDay());

        if ($service != 1) {
            $existingDailyBooking = BookingDaily::whereHas('service', function ($query) use ($service, $datetime, $expired_biometrik) {
                                    $query->where('service_id', $service)
                                            ->where(function ($query) use ($datetime, $expired_biometrik) {
                                                $query->whereBetween('datetime', [$datetime, $expired_biometrik])
                                                    ->orWhereBetween('expired_biometrik', [$datetime, $expired_biometrik]);
                                            });
                                    })
                                    ->where(function ($query) {
                                        $query->where('status_payment', '!=', 'expired')
                                              ->where('status_payment', '!=', 'rejected')
                                              ->where('status_biometrik', '!=', 'expired')
                                              ->where('status_biometrik', '!=', 'rejected');
                                    })
                                    ->count();
            
            $carbonDateTime = Carbon::parse($datetime);
            $play_start = $carbonDateTime->toTimeString();
            $play_end = $carbonDateTime->copy()->addMinutes(10)->toTimeString();

            $existingMemberBooking = BookingMember::where('service_id', $service)
                                    ->where(function ($query) use ($play_start, $play_end) {
                                        $query->whereBetween('play_start', [$play_start, $play_end])
                                            ->orWhereBetween('play_end', [$play_start, $play_end])
                                            ->orWhere(function ($query) use ($play_start, $play_end) {
                                                $query->where('play_start', '<=', $play_start)
                                                        ->where('play_end', '>=', $play_end);
                                            });
                                    })
                                    ->where(function ($query) {
                                        $query->where('status_payment', '!=', 'expired')
                                            ->where('status_payment', '!=', 'rejected')
                                            ->where('status_biometrik', '!=', 'expired')
                                            ->where('status_biometrik', '!=', 'rejected');
                                    })
                                    ->count();                              

            $totalExistingBookings = $existingDailyBooking + $existingMemberBooking;

            $serviceData = Service::find($service);

            if ($totalExistingBookings >= $serviceData->field_counts) {
                return redirect('booking/daily')->with('error', 'Maaf, sudah mencapai batas maksimal booking untuk jam tersebut.');
            }
        }

        if ($request->hasFile('identity')) {
            $imagePath = $request->file('identity')->store('public/booking-daily');
            $identity = basename($imagePath);
        } 

        $data = BookingDaily::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'identity' => $identity,
            'service_id' => $service,
            'rent_lights' => $request->rent_lights,
            'rent_ball' => $request->rent_ball,
            'rent_racket' => $request->rent_racket,
            'rent_bet' => $request->rent_bet,
            'datetime' => $datetime,
            'expired_payment' => $expired_payment,
            'expired_biometrik' => $expired_biometrik,
            'subtotal' => $request->subtotal,
            'ppn' => $request->ppn,
            'total' => $total,
            'payment_method' => 'Transfer',
            'app_name' => 'web',
        ]);

        if ($service == 1) {
            $categories = [
                'Dewasa' => $dewasa,
                'Anak' => $anak,
                'Pengantar' => $pengantar,
                'Tiket Buku (15 Lembar)' => $buku,
            ];

            foreach ($categories as $category => $qty) {
                if ($qty > 0) {
                    $priceDaily = PriceDaily::where('service_id', 1)->where('package', $category)->first();

                    $now = Carbon::now();
        
                    if ($now->isWeekend()) {
                        $service_price = $priceDaily->weekend;
                    } else {
                        $service_price = $priceDaily->weekday;
                    }
        
                    $amount_price_swimming = $service_price * $qty;
        
                    BookingDailyDetail::create([
                        'booking_daily_id' => $data->id,
                        'duration' => $request->schedule,
                        'kategori' => $category,
                        'service_price' => $service_price,
                        'qty' => $qty,
                        'amount_price_swimming' => $amount_price_swimming,
                    ]);
                }
            }            
        } else {
            BookingDailyDetail::create([
                'booking_daily_id' => $data->id,
                'duration' => $request->duration,
                'kategori' => $category,
                'roomy' => $request->usage,
                'qty' => 1,
            ]);
        }

        Mail::to($request->email)->send(new InvoiceBookingDailyMail($data));
        return redirect('booking/daily')->with('message', 'Booking berhasil! Mohon periksa email yang telah Anda daftarkan pada formulir yang tadi diisi.');
    }

    public function member()
    {
        $data = [
            'services' => Service::whereNot('id', 7)->get(),
            'prices' => PriceMember::all(),
            'schools' => PriceMember::where('member', 'Sekolah')->get(),
            'setting' => Setting::find(1),
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
        $category = $request->category;
        $identity = $request->identity;
        $service = $request->service;

        // Define operational hours
        $dayOfWeek = Carbon::parse($datetime)->dayOfWeek;
        $operationalHours = [
            1 => ['start' => '14:00', 'end' => '21:00'], // Monday
            2 => ['start' => '06:00', 'end' => '21:00'], // Tuesday
            3 => ['start' => '06:00', 'end' => '21:00'], // Wednesday
            4 => ['start' => '06:00', 'end' => '21:00'], // Thursday
            5 => ['start' => '06:00', 'end' => '21:00'], // Friday
            6 => ['start' => '06:00', 'end' => '21:00'], // Saturday
            0 => ['start' => '06:00', 'end' => '21:00'], // Sunday
        ];

        if ($service != 1) {
            // Adjust operational hours for service != 1
            $operationalHours = array_fill(0, 7, ['start' => '06:00', 'end' => '22:00']);
        }

        // Get operational hours for the current day
        $start = $operationalHours[$dayOfWeek]['start'];
        $end = $operationalHours[$dayOfWeek]['end'];
        
        // Create Carbon instances for start and end of the operational hours
        $startOfDay = Carbon::parse($datetime)->setTimeFromTimeString($start);
        $endOfDay = Carbon::parse($datetime)->setTimeFromTimeString($end);
        
        // Check if the datetime is within operational hours
        if (!Carbon::parse($datetime)->between($startOfDay, $endOfDay)) {
            return redirect('booking/member')->with('error', 'Booking gagal! Waktu yang dipilih berada di luar jam operasional.');
        }

        if ($category === 'Penghuni') {
            if (empty($identity)) {
                return redirect('booking/member')->with('error', 'Booking gagal! Silahkan isi bukti identitas terlebih dahulu.');
            }
        }

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
            $expired_biometrik = Carbon::parse($datetime)->addMonths($duration);
        } elseif ($duration === "week") {
            $expired_biometrik = Carbon::parse($datetime)->addWeeks();
        } elseif (is_numeric($duration)) {
            $expired_biometrik = Carbon::parse($datetime)->addHours($duration);
        } else {
            $expired_biometrik = Carbon::parse($datetime)->addMonths(1);
        }

        $packageTime = [
            "Per 2 Jam 1x Seminggu (PAGI)" => 2,
            "Per 3 Jam 1x Seminggu (PAGI)" => 3,
            "Per 2 Jam 1x Seminggu (SIANG)" => 2,
            "Per 4 Jam 1x Seminggu (SIANG)" => 4,
            "Per 3 Jam 1x Seminggu (SIANG)" => 3,
            "Per 1 Jam 1x Seminggu" => 1,
            "Per 2 Jam 1x Seminggu" => 2,
            "Per 3 Jam 1x Seminggu" => 3,
            "Paket Suka - Suka 10 Jam" => 10,
            "Paket Suka - Suka 12 Jam" => 12,
            "Paket Suka - Suka 15 Jam" => 15,
        ];

        $carbonDateTime = Carbon::parse($datetime);
        $date = $carbonDateTime->toDateString();
        $play_start = $carbonDateTime->toTimeString();

        if (array_key_exists($package, $packageTime)) {
            $play_end = $carbonDateTime->addHours($packageTime[$package])->format('H:i:s');
        } else {
            $play_end = null;
        }
        
        $existingBooking = BookingMember::where('school', $school)
                            ->whereNotNull('school')
                            ->where('status_biometrik', 'success')
                            ->first();

        if ($request->hasFile('identity')) {
            $imagePath = $request->file('identity')->store('public/booking-member');
            $identity = basename($imagePath);
        }

        $expired_payment = $package != 'Sekolah' ? Carbon::now()->addMinutes(20)->toDateTimeString() : null;
        $status_biometrik = $package == 'Sekolah' ? 'success' : 'pending';

        $subtotal = 0;
        $ppn = 0;
        $totalBook = 0;
        $subtotalSchool = 0;
        $ppnSchool = 0;
        $subtotalSchool = 0;

        if ($package == 'Sekolah') {
            $subtotalSchool = $request->subtotal;
            $ppnSchool = $request->ppn;
            $totalSchool = $total;
        } else {
            $subtotal = $request->subtotal;
            $ppn = $request->ppn;
            $totalBook = $total;
        }

        if ($service != 1) {
            $existingDailyBooking = BookingDaily::whereHas('service', function ($query) use ($service, $datetime, $expired_biometrik) {
                                    $query->where('service_id', $service)
                                            ->where(function ($query) use ($datetime, $expired_biometrik) {
                                                $query->whereBetween('datetime', [$datetime, $expired_biometrik])
                                                    ->orWhereBetween('expired_biometrik', [$datetime, $expired_biometrik]);
                                            });
                                    })
                                    ->where(function ($query) {
                                        $query->where('status_payment', '!=', 'expired')
                                              ->where('status_payment', '!=', 'rejected')
                                              ->where('status_biometrik', '!=', 'expired')
                                              ->where('status_biometrik', '!=', 'rejected');
                                    })
                                    ->count();
            
            $carbonDateTime = Carbon::parse($datetime);
            $playStart = $carbonDateTime->toTimeString();
            $playEnd = $carbonDateTime->copy()->addMinutes(10)->toTimeString();

            $existingMemberBooking = BookingMember::where('service_id', $service)
                                    ->where(function ($query) use ($playStart, $playEnd) {
                                        $query->whereBetween('play_start', [$playStart, $playEnd])
                                            ->orWhereBetween('play_end', [$playStart, $playEnd])
                                            ->orWhere(function ($query) use ($playStart, $playEnd) {
                                                $query->where('play_start', '<=', $playStart)
                                                        ->where('play_end', '>=', $playEnd);
                                            });
                                    })
                                    ->where(function ($query) {
                                        $query->where('status_payment', '!=', 'expired')
                                            ->where('status_payment', '!=', 'rejected')
                                            ->where('status_biometrik', '!=', 'expired')
                                            ->where('status_biometrik', '!=', 'rejected');
                                    })
                                    ->count();                              

            $totalExistingBookings = $existingDailyBooking + $existingMemberBooking;

            $serviceData = Service::find($service);

            if ($totalExistingBookings >= $serviceData->field_counts) {
                return redirect('booking/member')->with('error', 'Maaf, sudah mencapai batas maksimal booking untuk jam tersebut.');
            }
        }

        if (!$existingBooking) {
            $data = BookingMember::create([
                'user_id' => $user->id,
                'identity' => $identity,
                'service_id' => $service,
                'date' => $date,
                'play_start' => $play_start,
                'play_end' => $play_end,
                'member' => $request->member,
                'category' => $category,
                'package' => $package,
                'school' => $school,
                'subtotal' => $subtotal,
                'ppn' => $ppn,
                'total' => $totalBook,
                'total_for_school' => $total,
                'expired_payment' => $expired_payment,
                'expired_biometrik' => $expired_biometrik,
                'payment_method' => 'Transfer',
                'status_biometrik' => $status_biometrik,
                'app_name' => 'web',
            ]);
        } else {
            $existingBooking->total_for_school += $totalSchool;
            $existingBooking->save();
            $data = $existingBooking;
        }

        if (!empty($student)) {
            $bookingSchool = BookingSchool::create([
                'booking_member_id' => $data->id,
                'start_date' => $datetime,
                'student_counts' => $student,
                'lock' => $student,
                'subtotal' => $subtotalSchool,
                'ppn' => $ppnSchool,
                'total' => $totalSchool,
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
