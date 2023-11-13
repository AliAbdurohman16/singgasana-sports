<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();

        return view('backend.service.index', compact('services'));
    }

    public function create()
    {
        return view('backend.service.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price_daily' => 'required',
            'price_member' => 'required',
        ]);

        $price_daily = str_replace(['Rp ', '.', ','], ['', '', ''], $request->price_daily);
        $price_member = str_replace(['Rp ', '.', ','], ['', '', ''], $request->price_member);

        Service::create([
            'name' => $request->name,
            'price_daily' => $price_daily,
            'price_member' => $price_member,
        ]);

        return redirect('services')->with('message', 'Layanan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $service = Service::find($id);

        return view('backend.service.edit', compact('service'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'price_daily' => 'required',
            'price_member' => 'required',
        ]);

        $service = Service::find($id);

        $price_daily = str_replace(['Rp ', '.', ','], ['', '', ''], $request->price_daily);
        $price_member = str_replace(['Rp ', '.', ','], ['', '', ''], $request->price_member);

        $service->update([
            'name' => $request->name,
            'price_daily' => $price_daily,
            'price_member' => $price_member,
        ]);

        return redirect('services')->with('message', 'Layanan berhasil diubah');
    }

    public function destroy($id)
    {
        $service = Service::find($id);

        $service->delete();

        return response()->json(['message' => 'Layanan berhasil dihapus!']);
    }
}
