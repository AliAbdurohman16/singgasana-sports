<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Memberships;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookingController extends Controller
{
    public function index()
    {
        $memberships = Memberships::latest()->get();
        return view('backend.booking.index', compact('memberships'));
    }

    public function store(Request $request)
    {
        //
    }

    function member()
    {
        $memberships = Memberships::latest()->get();
        return view('backend.booking.index', compact('memberships'));
    }
}
