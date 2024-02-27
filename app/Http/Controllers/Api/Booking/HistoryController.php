<?php

namespace App\Http\Controllers\Api\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookingDaily;
use App\Models\BookingMember;
use App\Models\BookingSchool;
use App\Helpers\ResponseFormatter;

class HistoryController extends Controller
{
    public function daily()
    {
        $user = Auth::user();

        $dailies = BookingDaily::where('user_id', $user->id)->orderBy('status', 'asc')->get();

        return ResponseFormatter::success(['dailies' => $dailies], 'Services has been successfully displayed!');
    }

    public function member()
    {
        $user = Auth::user();

        $members = BookingMember::where('user_id', $user->id)->where('app_name', 'mobile')->orderBy('status', 'asc')->get();

        return ResponseFormatter::success(['members' => $members], 'Services has been successfully displayed!');
    }

    public function school()
    {
        $schools = BookingSchool::orderBy('status', 'asc')
                        ->join('booking_members', 'booking_schools.booking_member_id', '=', 'booking_members.id')
                        ->orderBy('booking_members.status', 'asc')
                        ->get(['booking_schools.*', 'booking_members.status']);

        return ResponseFormatter::success(['schools' => $schools], 'Services has been successfully displayed!');
    }
}
