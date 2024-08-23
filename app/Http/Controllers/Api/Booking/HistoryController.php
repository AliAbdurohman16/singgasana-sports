<?php

namespace App\Http\Controllers\Api\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookingDaily;
use App\Models\BookingMember;
use App\Models\BookingSchool;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function daily()
    {
        $user = Auth::user();

        $dailies = BookingDaily::with('service')->where('user_id', $user->id)->where('app_name', 'mobile')->latest()->take(10)->get();

        return ResponseFormatter::success(['dailies' => $dailies], 'Services has been successfully displayed!');
    }

    public function member()
    {
        $user = Auth::user();

        $members = BookingMember::with('service')->where('user_id', $user->id)->where('app_name', 'mobile')->latest()->take(10)->get();

        return ResponseFormatter::success(['members' => $members], 'Services has been successfully displayed!');
    }

    public function school()
    {
        $schools = BookingSchool::with('bookingMember.service')
                        ->join('booking_members', 'booking_schools.booking_member_id', '=', 'booking_members.id')
                        ->where('booking_members.app_name', 'mobile')
                        ->latest()
                        ->take(10)
                        ->get(['booking_schools.*', 'booking_members.status']);

        return ResponseFormatter::success(['schools' => $schools], 'Services has been successfully displayed!');
    }
}
