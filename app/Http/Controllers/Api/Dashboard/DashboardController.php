<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Page;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ResponseFormatter;

class DashboardController extends Controller
{
    public function index()
    {
        $pages = Page::where('slug', '!=', 'tentang-kami')->get();
        $facilities = [];

        foreach ($pages as $page) {
            $facilities[] = url('/api/pages/' . $page->slug);
        }

        $dashboard = [
            'user' => Auth::user(),
            'facilities' => $facilities,
            'articles' => Article::where('status', 'Publish')->with('category')->latest()->take(5)->get(),
        ];

        return ResponseFormatter::success(['dashboard' => $dashboard], 'Services has been successfully displayed!');
    }
}