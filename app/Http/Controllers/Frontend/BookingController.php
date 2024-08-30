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
                    ? Carbon::parse($datetime)->addHours(23)->endOfDay()->min(Carbon::parse($datetime)->endOfDay())
                    : Carbon::parse($datetime)->addHours(intval($request->duration))->endOfDay()->min(Carbon::parse($datetime)->endOfDay());

        $expired_biometrik = Carbon::now()->addMinutes(20);

        if ($service != 1) {
            // Check if there is an existing booking with the same service and overlapping datetime-expired range
            $existingBooking = BookingDaily::whereHas('service', function ($query) use ($service, $datetime, $expired_biometrik) {
                                    $query->where('service_id', $service)
                                            ->where(function ($query) use ($datetime, $expired_biometrik) {
                                                $query->whereBetween('datetime', [$datetime, $expired_biometrik])
                                                    ->orWhereBetween('expired_biometrik', [$datetime, $expired_biometrik]);
                                            });
                                    })->count();

            $serviceData = Service::find($service);

            if ($existingBooking >= $serviceData->field_counts) {
                // If there are already bookings, return a failure message
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
                        'booking_id' => $data->id,
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
                'booking_id' => $data->id,
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
        
        $existingBooking = BookingMember::where('school', $school)
                            ->whereNotNull('school')
                            ->where('status_biometrik', 'Pending')
                            ->first();

        if ($request->hasFile('identity')) {
            $imagePath = $request->file('identity')->store('public/booking-member');
            $identity = basename($imagePath);
        }

        $expired_payment = $package != 'Sekolah' ? Carbon::now()->addMinutes(20)->toDateTimeString() : null;

        if (!$existingBooking) {
            $data = BookingMember::create([
                'user_id' => $user->id,
                'identity' => $identity,
                'service_id' => $request->service,
                'datetime' => $datetime,
                'member' => $request->member,
                'category' => $category,
                'package' => $package,
                'school' => $school,
                'subtotal' => $request->subtotal,
                'ppn' => $request->ppn,
                'total' => $total,
                'expired_payment' => $expired_payment,
                'expired_biometrik' => $expired_biometrik,
                'payment_method' => 'Transfer',
                'app_name' => 'web',
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
