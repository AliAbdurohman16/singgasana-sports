<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\User;
use Conner\Tagging\Model\Tag;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class EventController extends Controller
{
    public function index()
    {
        $data = [
            'events' => Event::orderBy('created_at', 'desc')->paginate(5),
            'categories' => EventCategory::all(),
            'recentPosts' => Event::latest()->take(3)->get(),
            'popularPosts' => Event::orderBy('viewers', 'desc')->take(3)->get(),
        ];

        return view('frontend.event.index', $data);
    }

    public function single($slug)
    {
        $event = Event::where(['slug' => $slug, 'status' => 'Publish'])->first();

        $data = [
            'event' => $event,
            'categories' => EventCategory::all(),
            'recentPosts' => Event::latest()->take(3)->get(),
            'popularPosts' => Event::orderBy('viewers', 'desc')->take(3)->get(),
            'tags' => Tag::select('name', 'slug')->distinct()->get(),
        ];

        $event->update([
            'viewers' => $event->viewers + 1,
        ]);

        return view('frontend.event.single', $data);
    }

    public function date($date)
    {
        $data = [
            'date' => $date,
            'events' => Event::whereDate('created_at', $date)->orderBy('created_at', 'desc')->paginate(5),
            'categories' => EventCategory::all(),
            'recentPosts' => Event::latest()->take(3)->get(),
            'popularPosts' => Event::orderBy('viewers', 'desc')->take(3)->get(),
        ];

        return view('frontend.event.date', $data);
    }

    public function category($slug)
    {
        $category = EventCategory::where('slug', $slug)->first();

        $data = [
            'category' => $category,
            'events' => $category->event()->orderBy('created_at', 'desc')->paginate(5),
            'categories' => EventCategory::all(),
            'recentPosts' => Event::latest()->take(3)->get(),
            'popularPosts' => Event::orderBy('viewers', 'desc')->take(3)->get(),
        ];

        return view('frontend.event.category', $data);
    }

    public function search(Request $request)
    {
        $search = $request->input('keyword');

        $data = [
            'search' => $search,
            'events' => Event::where(function ($query) use ($search) {
                            $query->where('title', 'LIKE', "%$search%")
                                ->orWhere('content', 'LIKE', "%$search%")
                                ->orWhere('created_at', 'LIKE', "%$search%");
                        })
                        ->orWhereHas('eventCategory', function ($query) use ($search) {
                            $query->where('title', 'LIKE', "%$search%")
                                ->orWhere('slug', 'LIKE', "%$search%");
                        })
                        ->paginate(5),
            'categories' => EventCategory::all(),
            'recentPosts' => Event::latest()->take(3)->get(),
            'popularPosts' => Event::orderBy('viewers', 'desc')->take(3)->get(),
        ];

        return view('frontend.event.search', $data);
    }

}
