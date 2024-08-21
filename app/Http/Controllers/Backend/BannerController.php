<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['banners'] = Banner::all();

        return view('backend.banner.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.banner.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,webp,avif|max:2048',
            'link' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = basename($request->file('image')->store('public/banner'));
        }

        Banner::create($data);

        return redirect('banners')->with('message', 'Data berhasil ditambahkan!');
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
        $data['banner'] = Banner::find($id);

        return view('backend.banner.edit', $data);
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
        $banner = Banner::find($id);

        $data = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,webp,avif|max:2048',
            'link' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            if ($banner->image && Storage::exists('public/banner/' . $banner->image)) {
                Storage::delete('public/banner/' . $banner->image);
            }

            $data['image'] = basename($request->file('image')->store('public/banner'));
        }

        $banner->update($data);

        return redirect('banners')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);

        if ($banner->image) {
            Storage::delete('public/banner/' . $banner->image);

            $banner->delete();

            return response()->json(['message' => 'Data berhasil dihapus!']);
        }
    }
}
