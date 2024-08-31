<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BookingDaily;
use App\Models\BookingMember;
use App\Models\Article;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil jadwal harian
        $dailySchedules = BookingDaily::select(
                                'booking_dailies.id', 
                                'booking_dailies.service_id as service_id',
                                'services.name as service_name', 
                                'booking_dailies.datetime as start', 
                                'booking_dailies.expired_biometrik as end'
                            )
                            ->join('services', 'booking_dailies.service_id', '=', 'services.id')
                            ->where('booking_dailies.status_biometrik', 'success')
                            ->orderBy('start');

        // Ambil jadwal member
        $memberSchedules = BookingMember::select(
                                'booking_members.id', 
                                'booking_members.service_id as service_id',
                                'services.name as service_name', 
                                'booking_members.play_start as start', 
                                'booking_members.play_end as end'
                            )
                            ->join('services', 'booking_members.service_id', '=', 'services.id')
                            ->where('booking_members.status_biometrik', 'success')
                            ->orderBy('start');

        // Gabungkan jadwal
        $schedules = $dailySchedules
                            ->union($memberSchedules)
                            ->get()
                            ->map(function ($schedule) {
                                $startDate = Carbon::parse($schedule->start);
                                $endDate = $schedule->end ? Carbon::parse($schedule->end) : null;
                                $dayOfWeek = $startDate->dayOfWeek;

                                // Atur ulang start berdasarkan hari
                                if ($schedule->service_id == 1) {
                                    if ($dayOfWeek == Carbon::MONDAY) {
                                        $schedule->start = $startDate->setTime(14, 0, 0)->toDateTimeString();
                                    }
                                }

                                // Atur ulang end jika null atau tidak valid
                                if ($schedule->service_id == 1) {
                                    if ($endDate === null || $endDate->lt($startDate)) {
                                        $schedule->end = $startDate->copy()->setTime(21, 0, 0)->toDateTimeString();
                                    } else {
                                        $schedule->end = $endDate->toDateTimeString();
                                    }
                                } else {
                                    if ($endDate === null || $endDate->lt($startDate)) {
                                        $schedule->end = $startDate->copy()->setTime(22, 0, 0)->toDateTimeString();
                                    } else {
                                        $schedule->end = $endDate->toDateTimeString();
                                    }
                                }

                                return $schedule;
                            });

        $data = [
            'profile' => Auth::user(),
            'bookingDailies' => BookingDaily::count(),
            'bookingMembers' => BookingMember::count(),
            'articles' => Article::count(),
            'officers' => User::whereHas('roles', function ($query) {
                            $query->where('name', '=', 'admin')->orWhere('name', '=', 'cashier');
                        })->count(),
            'schedules' => $schedules,
            'histories' => BookingMember::where('user_id', Auth::user()->id)
                            ->where('status_payment', 'success')
                            ->get(),
        ];

        return view('backend.dashboard.index', $data);
    }
}
