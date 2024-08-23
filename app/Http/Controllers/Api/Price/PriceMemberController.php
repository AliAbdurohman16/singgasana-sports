<?php

namespace App\Http\Controllers\Api\Price;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PriceMember;
use App\Helpers\ResponseFormatter;

class PriceMemberController extends Controller
{
    public function index()
    {
        $price_members = PriceMember::with('service')->get();

        return ResponseFormatter::success(['price_members' => $price_members], 'Services has been successfully displayed!');
    }
}
