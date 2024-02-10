<?php

namespace App\Http\Controllers\Api\Price;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PriceDaily;
use App\Helpers\ResponseFormatter;

class PriceDailyController extends Controller
{
    public function index()
    {
        $price_dailies = PriceDaily::with('service')->get();

        return ResponseFormatter::success(['price_dailies' => $price_dailies], 'Services has been successfully displayed!');
    }
}
