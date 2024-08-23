<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facility;

class FacilityController extends Controller
{
    public function index($slug)
    {
        $facilities = Facility::where('slug', $slug)->with('images')->get();

        return view('frontend.facility.index', compact('facilities'));
    }
}
