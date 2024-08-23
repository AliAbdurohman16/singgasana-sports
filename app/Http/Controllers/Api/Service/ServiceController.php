<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();

        return ResponseFormatter::success(['services' => $services], 'Services has been successfully displayed!');
    }
}
