<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function index($slug)
    {
        $pages = Page::where('slug', $slug)->with('images')->get();

        return view('frontend.page.index', compact('pages'));
    }
}
