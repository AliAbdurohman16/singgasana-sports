<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::with('images')->get();

        return view('backend.facility.index', compact('facilities'));
    }

    public function create()
    {
        return view('backend.facility.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|max:2048',
            'image.*' => 'mimes:jpg,png,jpeg|image|max:2048',
        ]);

        $facility = Facility::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'description' => $request->description,
        ]);

        if ($request->hasFile('image')) {
            $images = $request->file('image');
            foreach ($images as $image) {
                $path = basename($image->store('public/facility'));

                Image::create([
                    'path' => $path,
                    'facility_id' => $facility->id,
                ]);
            }
        }

        return redirect('facility')->with('message', 'Data berhasil ditambahkan!');
    }


    public function show($id)
    {
        $facility = Facility::with('images')->find($id);

        return view('backend.facility.show', compact('facility'));
    }

    public function edit($id)
    {
        $facility = Facility::with('images')->find($id);

        return view('backend.facility.edit', compact('facility'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'max:2048',
            'image.*' => 'mimes:jpg,png,jpeg|image|max:2048',
        ]);

        $facility = Facility::findOrFail($id);

        if ($request->hasFile('image')) {
            foreach ($facility->images as $image) {
                Storage::delete('public/facility/' . $image->path);
                $image->delete();
            }

            $images = $request->file('image');
            foreach ($images as $image) {
                $path = basename($image->store('public/facility'));
                Image::create([
                    'path' => $path,
                    'facility_id' => $facility->id,
                ]);
            }
        }

        $facility->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'description' => $request->description,
        ]);

        return redirect('facility')->with('message', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $facility = Facility::find($id);

        foreach ($facility->images as $image) {
            Storage::delete('public/facility/' . $image->path);
            $image->delete();
        }

        $facility->delete();

        return response()->json(['message' => 'Data berhasil dihapus!']);
    }

}
