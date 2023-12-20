<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PriceDaily;
use App\Models\PriceMember;
use App\Models\Service;

class TableTennisController extends Controller
{
    public function index()
    {
        $data = [
            'dailies' => PriceDaily::where('service_id', 5)->get(),
            'members' => PriceMember::where('service_id', 5)->get(),
        ];

        return view('backend.service.table-tennis.index', $data);
    }

    public function dailyEdit($id)
    {
        $data['daily'] = PriceDaily::where('id', $id)->where('service_id', 5)->first();

        return view('backend.service.table-tennis.edit-daily', $data);
    }

    public function dailyUpdate(Request $request,$id)
    {
        $daily = PriceDaily::find($id);

        $price = str_replace(['Rp ', '.', ','], ['', '', ''], $request->price);

        $daily->update([
            'price' => $price,
        ]);

        $service = Service::find($daily->service_id);

        $service->update([
            'field_counts' => $request->field_counts
        ]);

        return redirect('service/table-tennis')->with('message', 'Layanan berhasil diubah');
    }

    public function memberEdit($id)
    {
        $data['member'] = PriceMember::where('id', $id)->where('service_id', 5)->first();

        return view('backend.service.table-tennis.edit-member', $data);
    }

    public function memberUpdate(Request $request,$id)
    {
        $member = PriceMember::find($id);

        $two_hours = str_replace(['Rp ', '.', ','], ['', '', ''], $request->two_hours);
        $three_hours = str_replace(['Rp ', '.', ','], ['', '', ''], $request->three_hours);
        $ten_hours = str_replace(['Rp ', '.', ','], ['', '', ''], $request->ten_hours);
        $twelve_hours = str_replace(['Rp ', '.', ','], ['', '', ''], $request->twelve_hours);
        $fifteen_hours = str_replace(['Rp ', '.', ','], ['', '', ''], $request->fifteen_hours);

        $member->update([
            'two_hours' => $two_hours,
            'three_hours' => $three_hours,
            'ten_hours' => $ten_hours,
            'twelve_hours' => $twelve_hours,
            'fifteen_hours' => $fifteen_hours,
        ]);

        return redirect('service/table-tennis')->with('message', 'Layanan berhasil diubah');
    }
}
