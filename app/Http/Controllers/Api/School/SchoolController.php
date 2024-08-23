<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PriceMember;
use App\Helpers\ResponseFormatter;

class SchoolController extends Controller
{
    public function index()
    {
        $schools = PriceMember::with('service')->where('member', 'Sekolah')->get();

        return ResponseFormatter::success(['schools' => $schools], 'Services has been successfully displayed!');
    }
}
