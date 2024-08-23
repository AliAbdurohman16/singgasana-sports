<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $data['galleries'] = Gallery::all();

        return view('backend.gallery.index', $data);
    }

    public function create()
    {
        return view('backend.gallery.add');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'thumbnail' => 'required|mimes:jpg,png,jpeg,webp,avif|image|max:2048',
            'title' => 'required',
            'short_description' => 'required',
            'foto_1' => 'mimes:jpg,png,jpeg,webp,avif|image|max:2048',
            'title_foto_1' => 'nullable',
            'foto_2' => 'mimes:jpg,png,jpeg,webp,avif|image|max:2048',
            'title_foto_2' => 'nullable',
            'foto_3' => 'mimes:jpg,png,jpeg,webp,avif|image|max:2048',
            'title_foto_3' => 'nullable',
            'description' => 'required',
        ]);

        $data['slug'] = Str::slug($data['title']);

        $fields = ['thumbnail', 'foto_1', 'foto_2', 'foto_3'];

        foreach ($fields as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = basename($request->file($field)->store('public/gallery'));
            }
        }

        Gallery::create($data);

        return redirect('galleries')->with('message', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data['gallery'] = Gallery::find($id);

        return view('backend.gallery.edit', $data);
    }

    public function update(Request $request,$id)
    {
        $gallery = Gallery::find($id);

        $data = $request->validate([
            'thumbnail' => '|mimes:jpg,png,jpeg,webp,avif|image|max:2048',
            'title' => 'required',
            'short_description' => 'required',
            'foto_1' => 'mimes:jpg,png,jpeg,webp,avif|image|max:2048',
            'title_foto_1' => 'nullable',
            'foto_2' => 'mimes:jpg,png,jpeg,webp,avif|image|max:2048',
            'title_foto_2' => 'nullable',
            'foto_3' => 'mimes:jpg,png,jpeg,webp,avif|image|max:2048',
            'title_foto_3' => 'nullable',
            'description' => 'required',
        ]);

        $data['slug'] = Str::slug($data['title']);

        $fields = ['thumbnail', 'foto_1', 'foto_2', 'foto_3'];

        foreach ($fields as $field) {
            if ($request->hasFile($field)) {
                if ($gallery->$field && Storage::exists('public/gallery/' . $gallery->$field)) {
                    Storage::delete('public/gallery/' . $gallery->$field);
                }

                
                $data[$field] = basename($request->file($field)->store('public/gallery'));
            }
        }

        $gallery->update($data);

        return redirect('galleries')->with('message', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $gallery = Gallery::find($id);

        $fields = ['thumbnail', 'foto_1', 'foto_2', 'foto_3'];

        foreach ($fields as $field) {
            if ($gallery->$field && Storage::exists('public/gallery/' . $gallery->$field)) {
                Storage::delete('public/gallery/' . $gallery->$field);
            }
        }

        $gallery->delete();

        return response()->json(['message' => 'Data berhasil dihapus!']);
    }
}
