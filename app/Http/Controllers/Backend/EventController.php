<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Image;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['events'] = Event::orderBy('created_at', 'desc')->get();

        return view('backend.event.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = EventCategory::all();

        return view('backend.event.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
            'image.*' => 'required|mimes:jpg,png,jpeg|image|max:2048',
        ]);

        $event = Event::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'content' => $request->content,
            'user_id' => Auth::user()->id,
            'event_category_id' => $request->category,
            'status' => $request->status
        ]);

        if ($request->hasFile('image')) {
            $images = $request->file('image');
            foreach ($images as $image) {
                $path = basename($image->store('public/event'));

                Image::create([
                    'path' => $path,
                    'event_id' => $event->id,
                ]);
            }
        }

        return redirect('event')->with('message', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'event' => Event::find($id),
            'categories' => EventCategory::all(),
        ];

        return view('backend.event.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
            'image.*' => 'mimes:jpg,png,jpeg|image|max:2048',
        ]);

        $event = Event::find($id);

        if ($request->hasFile('image')) {
            foreach ($event->images as $image) {
                Storage::delete('public/event/' . $image->path);
                $image->delete();
            }

            $images = $request->file('image');
            foreach ($images as $image) {
                $path = basename($image->store('public/event'));
                Image::create([
                    'path' => $path,
                    'event_id' => $event->id,
                ]);
            }
        }

        $event->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'content' => $request->content,
            'user_id' => Auth::user()->id,
            'event_category_id' => $request->category,
            'status' => $request->status
        ]);

        return redirect('event')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);

        foreach ($event->images as $image) {
            Storage::delete('public/event/' . $image->path);
            $image->delete();
        }

        $event->delete();

        return response()->json(['message' => 'Data berhasil dihapus!']);
    }
}
