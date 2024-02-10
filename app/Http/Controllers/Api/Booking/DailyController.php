<?php

namespace App\Http\Controllers\Api\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\BookingDaily;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\InvoiceBookingDailyMail;
use App\Helpers\ResponseFormatter;
use Carbon\Carbon;


class DailyController extends Controller
{
    public function store(Request $request)
    {
        // get the currently logged in user
        $user = Auth::user();

        // if the user is not logged in, return unauthorized response
        if (!$user) {
            return ResponseFormatter::error('Unauthorized', 'Unauthorized', 401);
        }

        $service = $request->service;
        $datetime = $request->datetime;
        $category = $request->category;
        $dewasa = $request->dewasa;
        $anak = $request->anak;
        $pengantar = $request->pengantar;
        $buku = $request->buku;
        $total = $request->total;

        if ($total == 0) {
            return ResponseFormatter::error(null, 'Booking gagal! Silahkan lengkapi form isian tersebut.', 422);
        }

        if (empty($datetime)) {
            return ResponseFormatter::error(null, 'Booking gagal! Tanggal Mulai wajib diisi!.', 422);
        }

        if ($service == 1) {
            if ($dewasa != 0 && $anak != 0 && $pengantar != 0 && $buku != 0) {
                $information = 'Dewasa ' . $dewasa . ' Orang, Anak ' . $anak . ' Orang, Pengantar ' . $pengantar . ' Orang, Tiket Buku (15 Lembar) ' . $buku . ' Buah';
            } else if ($dewasa != 0 && $anak != 0 && $pengantar != 0) {
                $information = 'Dewasa ' . $dewasa . ' Orang, Anak ' . $anak . ' Orang, Pengantar ' . $pengantar . ' Orang';
            } else if ($dewasa != 0 && $anak != 0) {
                $information = 'Dewasa ' . $dewasa . ' Orang, Anak ' . $anak . ' Orang';
            } else if ($dewasa != 0) {
                $information = 'Dewasa ' . $dewasa . ' Orang';
            } else if ($anak != 0) {
                $information = 'Anak ' . $anak . ' Orang';
            } else if ($pengantar != 0) {
                $information = 'Pengantar ' . $pengantar . ' Orang';
            } else if ($buku != 0) {
                $information = 'Tiket Buku (15 Lembar) ' . $buku . ' Buah';
            }

            $time = $request->schedule;
        } else if ($service == 5 || $service == 6) {
            $information = $category;
            $time = $request->duration;
        } else {
            $information = $category."(".$request->usage.")";
            $time = $request->duration;
        }

        $expired = ($service == 1)
                    ? Carbon::parse($datetime)->addHours(23)->endOfDay()->min(Carbon::parse($datetime)->endOfDay())
                    : Carbon::parse($datetime)->addHours(intval($request->duration))->endOfDay()->min(Carbon::parse($datetime)->endOfDay());

        if ($service != 1) {
            // Check if there is an existing booking with the same service and overlapping datetime-expired range
            $existingBooking = BookingDaily::whereHas('service', function ($query) use ($service, $datetime, $expired) {
                                    $query->where('service_id', $service)
                                            ->where(function ($query) use ($datetime, $expired) {
                                                $query->whereBetween('datetime', [$datetime, $expired])
                                                    ->orWhereBetween('expired', [$datetime, $expired]);
                                            });
                                    })->count();

            $serviceData = Service::find($service);

            if ($existingBooking >= $serviceData->field_counts) {
                // If there are already bookings, return a failure message
                return ResponseFormatter::error(null, 'Maaf, sudah mencapai batas maksimal booking untuk jam tersebut.', 422);
            }
        }

        $data = BookingDaily::create([
            'user_id' => $user->id,
            'service_id' => $service,
            'datetime' => $datetime,
            'information' => $information,
            'duration' => $time,
            'total' => $total,
            'expired' => $expired,
        ]);

        Mail::to($user->email)->send(new InvoiceBookingDailyMail($data));

        return ResponseFormatter::success(['booking_daily' => $data], 'Booking berhasil! Mohon periksa email yang telah terdaftar.');
    }
}
