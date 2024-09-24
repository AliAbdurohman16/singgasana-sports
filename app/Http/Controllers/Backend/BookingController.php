<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BookingDaily;
use App\Models\BookingMember;
use App\Models\PriceMember;
use App\Models\Service;
use App\Models\BookingSchool;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\ValidationBookingDailyMail;
use App\Mail\ValidationBookingMemberMail;
use App\Mail\ValidationBookingSchoolMail;
use App\Mail\InvoiceBookingMemberMail;
use App\Mail\InvoiceBookingSchoolMail;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $histories = BookingMember::where('user_id', Auth::user()->id)
                        ->orderBy('status_payment', 'asc')
                        ->get();

        return view('backend.booking.histories.index', compact('histories'));
    }

    public function create()
    {
        $data = [
            'services' => Service::whereNot('id', 7)->get(),
            'prices' => PriceMember::all(),
            'schools' => PriceMember::where('member', 'Sekolah')->get(),
            'setting' => Setting::find(1),
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
            return redirect('booking/create')->with('error', 'Booking gagal! Waktu yang dipilih berada di luar jam operasional.');
        }

        if ($category === 'Penghuni') {
            if (empty($identity)) {
                return redirect('booking/create')->with('error', 'Booking gagal! Silahkan isi bukti identitas terlebih dahulu.');
            }
        }

        if ($total == 0) {
            return redirect('booking/create')->with('error', 'Booking gagal! Silahkan lengkapi form isian tersebut.');
        }

        if (empty($datetime)) {
            return redirect('booking/create')->with('error', 'Booking gagal! Tanggal Mulai wajib diisi!.');
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
                return redirect('booking/create')->with('error', 'Maaf, sudah mencapai batas maksimal booking untuk jam tersebut.');
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

        return redirect('booking/create')->with('message', 'Booking berhasil! Mohon periksa email yang telah terdaftar.');
    }

    public function show($id)
    {
        $data = [
            'schools' => BookingSchool::where('booking_member_id', $id)->get(),
            'member' => BookingMember::find($id),
            'setting' => Setting::find(1),
        ];

        return view('backend.booking.histories.detail', $data);
    }

    public function daily()
    {
        $dailies = BookingDaily::orderBy('status_payment', 'asc')->get();

        return view('backend.booking.dailies.index', compact('dailies'));
    }

    public function validationDaily(Request $request, $id)
    {
        $daily = BookingDaily::find($id);

        // Generate a 6-Digit PIN
        $pin = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Generate QR Code
        $qr = QrCode::size(100)->generate($pin);

        // Save QR Code as PNG
        $qrPath = public_path('qr_codes/'); // Folder to save QR codes
        $qrFileName = 'qr_' . time() . '.png'; // Generate a unique file name

        // Save QR code as PNG
        QrCode::size(300)->format('png')->backgroundColor(255, 255, 255)->margin(10)->generate($pin, $qrPath . $qrFileName);

        $daily->update([
            'pin' => $pin,
            'qr' => $qrFileName,
            'status_payment' => 'success',
            'status_biometrik' => 'success',
        ]);

        Mail::to($daily->email)->send(new ValidationBookingDailyMail($daily));

        return response()->json(['message' => 'Data berhasil divalidasi!']);
    }

    public function showDaily($id)
    {
        $daily = BookingDaily::find($id);
        $setting = Setting::find(1);

        return view('backend.booking.dailies.detail', compact('daily', 'setting'));
    }

    public function member()
    {
        $members = BookingMember::orderBy('status_payment', 'asc')->whereNot('package', 'Sekolah')->get();

        return view('backend.booking.members.index', compact('members'));
    }

    public function validationMember(Request $request, $id)
    {
        $member = BookingMember::find($id);

        // Generate a 6-Digit PIN
        $pin = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Generate QR Code
        $qr = QrCode::size(100)->generate($pin);

        // Save QR Code as PNG
        $qrPath = public_path('qr_codes/'); // Folder to save QR codes
        $qrFileName = 'qr_' . time() . '.png'; // Generate a unique file name

        // Save QR code as PNG
        QrCode::size(300)->format('png')->backgroundColor(255, 255, 255)->margin(10)->generate($pin, $qrPath . $qrFileName);

        $member->update([
            'pin' => $pin,
            'qr' => $qrFileName,
            'status_payment' => 'success',
            'status_biometrik' => 'success',
        ]);

        Mail::to($member->user->email)->send(new ValidationBookingMemberMail($member));

        return response()->json(['message' => 'Data berhasil divalidasi!']);
    }

    public function showMember($id)
    {
        $member = BookingMember::find($id);
        $setting = Setting::find(1);

        return view('backend.booking.members.detail', compact('member', 'setting'));
    }

    public function school()
    {
        $schools = BookingSchool::orderBy('status_payment', 'asc')
                        ->join('booking_members', 'booking_schools.booking_member_id', '=', 'booking_members.id')
                        ->orderBy('booking_members.status_payment', 'asc')
                        ->get(['booking_schools.*', 'booking_members.status_payment']);

        $validations = BookingMember::orderBy('status_payment', 'asc')->where('package', 'Sekolah')->get();

        return view('backend.booking.schools.index', compact('schools', 'validations'));
    }

    public function validationSchool(Request $request, $id)
    {
        $member = BookingMember::find($id);

        // Generate a 6-Digit PIN
        $pin = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Generate QR Code
        $qr = QrCode::size(100)->generate($pin);

        // Save QR Code as PNG
        $qrPath = public_path('qr_codes/'); // Folder to save QR codes
        $qrFileName = 'qr_' . time() . '.png'; // Generate a unique file name

        // Save QR code as PNG
        QrCode::size(300)->format('png')->backgroundColor(255, 255, 255)->margin(10)->generate($pin, $qrPath . $qrFileName);

        $member->update([
            'pin' => $pin,
            'qr' => $qrFileName,
            'status_payment' => 'success',
            'status_biometrik' => 'success',
        ]);

        Mail::to($member->user->email)->send(new ValidationBookingSchoolMail($member));

        return response()->json(['message' => 'Data berhasil divalidasi!']);
    }

    public function showSchool($id)
    {
        $schools = BookingSchool::where('booking_member_id', $id)->get();
        $setting = Setting::find(1);

        return view('backend.booking.schools.detail', compact('schools', 'setting'));
    }

    public function notPresent(Request $request, $id)
    {
        $school = BookingSchool::find($id);
        $priceMember = PriceMember::where('service_id', 1)->where('member', 'Sekolah')->first();
        $setting = Setting::find(1);
        $member = BookingMember::find($school->booking_member_id);

        $not_present = $request->not_present;
        $result = $school->student_counts - $not_present;

        $subtotal = $priceMember->price * $result;
        $ppn = ($subtotal * $setting->ppn) / 100;
        $total = $subtotal + $ppn;
        
        $existingTotal = BookingSchool::where('booking_member_id', $school->booking_member_id)
                                        ->where('id', '!=', $school->id)
                                        ->sum('total');
        $total_for_school = $existingTotal + $total;
        // dd($subtotal, $ppn, $total, $existingTotal, $total_for_school);
        
        $school->update([
            'student_counts' => $result,
            'not_present' => $not_present,
            'lock' => $result,
            'subtotal' => $subtotal,
            'ppn' => $ppn,
            'total' => $total,
        ]);

        $member->update(['total_for_school' => $total_for_school]);

        return redirect()->back()->with('message', 'Siswa tidak hadir berhasil diinputkan!');
    }
}
