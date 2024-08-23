<?php

namespace App\Http\Controllers\Api\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Helpers\ResponseFormatter;

class PageController extends Controller
{
    public function index($slug)
    {
        $page = Page::where('slug', $slug)->with('images')->first();

        return ResponseFormatter::success(['page' => $page], 'Services has been successfully displayed!');
    }
}
