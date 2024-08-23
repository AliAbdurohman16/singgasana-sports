<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $data['galleries'] = Gallery::all();

        return view('frontend.gallery.index', $data);
    }

    public function detail($slug)
    {
        $data['gallery'] = Gallery::where('slug', $slug)->first();
        
        return view('frontend.gallery.detail', $data);
    }
}
