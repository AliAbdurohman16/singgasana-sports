<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BookingDaily;
use App\Models\BookingMember;
use App\Models\Article;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'profile' => Auth::user(),
            'bookingDailies' => BookingDaily::count(),
            'bookingMembers' => BookingMember::count(),
            'articles' => Article::count(),
            'officers' => User::whereHas('roles', function ($query) {
                            $query->where('name', '=', 'admin')->orWhere('name', '=', 'cashier');
                        })->count(),
            'schedules' => BookingDaily::all(),
            'histories' => BookingMember::where('user_id', Auth::user()->id)
                            ->where('status', 'success')
                            ->get(),
        ];

        return view('backend.dashboard.index', $data);
    }
}
