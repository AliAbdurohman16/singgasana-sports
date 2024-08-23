<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::with('images')->get();

        return view('backend.page.index', compact('pages'));
    }

    public function create()
    {
        return view('backend.page.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|max:2048',
            'image.*' => 'mimes:jpg,png,jpeg,webp|image|max:2048',
            'title' => 'required',
            'content' => 'required',
        ]);

        $page = Page::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'content' => $request->content,
        ]);

        if ($request->hasFile('image')) {
            $images = $request->file('image');
            foreach ($images as $image) {
                $path = basename($image->store('public/page'));

                Image::create([
                    'path' => $path,
                    'page_id' => $page->id,
                ]);
            }
        }

        return redirect('page')->with('message', 'Data berhasil ditambahkan!');
    }

    public function show($id)
    {
        $pages = Page::with('images')->find($id);

        return view('backend.page.detail', compact('pages'));
    }

    public function edit($id)
    {
        $pages = Page::with('images')->find($id);

        return view('backend.page.edit', compact('pages'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'image' => 'max:2048',
            'image.*' => 'mimes:jpg,png,jpeg,webp|image|max:2048',
            'title' => 'required',
            'content' => 'required',
        ]);

        $pages = Page::findOrFail($id);

        if ($request->hasFile('image')) {
            foreach ($pages->images as $image) {
                Storage::delete('public/page/' . $image->path);
                $image->delete();
            }

            $images = $request->file('image');
            foreach ($images as $image) {
                $path = basename($image->store('public/page'));
                Image::create([
                    'path' => $path,
                    'page_id' => $pages->id,
                ]);
            }
        }

        $pages->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'content' => $request->content,
        ]);

        return redirect('page')->with('message', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $pages = Page::find($id);
        foreach ($pages->images as $image) {
            Storage::delete('public/page/' . $image->path);
            $image->delete();
        }

        $pages->delete();
        return response()->json(['status' => 'Data berhasil dihapus!']);
    }
}
