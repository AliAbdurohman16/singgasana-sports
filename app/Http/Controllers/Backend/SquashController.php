<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PriceDaily;
use App\Models\PriceMember;

class SquashController extends Controller
{
    public function index()
    {
        $data = [
            'dailies' => PriceDaily::where('service_id', 6)->get(),
            'members' => PriceMember::where('service_id', 6)->get(),
        ];

        return view('backend.service.squash.index', $data);
    }

    public function dailyEdit($id)
    {
        $data['daily'] = PriceDaily::where('id', $id)->where('service_id', 6)->first();

        return view('backend.service.squash.edit-daily', $data);
    }

    public function dailyUpdate(Request $request,$id)
    {
        $daily = PriceDaily::find($id);

        $price = str_replace(['Rp ', '.', ','], ['', '', ''], $request->price);

        $daily->update([
            'price' => $price,
        ]);

        return redirect('service/squash')->with('message', 'Layanan berhasil diubah');
    }

    public function memberEdit($id)
    {
        $data['member'] = PriceMember::where('id', $id)->where('service_id', 6)->first();

        return view('backend.service.squash.edit-member', $data);
    }

    public function memberUpdate(Request $request,$id)
    {
        $member = PriceMember::find($id);

        $one_hours = str_replace(['Rp ', '.', ','], ['', '', ''], $request->one_hours);

        $member->update([
            'one_hours' => $one_hours,
        ]);

        return redirect('service/squash')->with('message', 'Layanan berhasil diubah');
    }
}
