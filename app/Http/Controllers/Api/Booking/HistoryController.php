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
        $dailies = BookingDaily::orderBy('status', 'asc')->get();

        return ResponseFormatter::success(['dailies' => $dailies], 'Services has been successfully displayed!');
    }

    public function member()
    {
        $members = BookingMember::orderBy('status', 'asc')->get();

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
