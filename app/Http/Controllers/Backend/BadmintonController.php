<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PriceDaily;
use App\Models\PriceMember;

class BadmintonController extends Controller
{
    public function index()
    {
        $data = [
            'dailies' => PriceDaily::where('service_id', 3)->get(),
            'members' => PriceMember::where('service_id', 3)->get(),
        ];

        return view('backend.service.badminton.index', $data);
    }

    public function dailyEdit($id)
    {
        $data['daily'] = PriceDaily::where('id', $id)->where('service_id', 3)->first();

        return view('backend.service.badminton.edit-daily', $data);
    }

    public function dailyUpdate(Request $request,$id)
    {
        $daily = PriceDaily::find($id);

        $morning = str_replace(['Rp ', '.', ','], ['', '', ''], $request->morning);
        $afternoon = str_replace(['Rp ', '.', ','], ['', '', ''], $request->afternoon);

        $daily->update([
            'morning' => $morning,
            'afternoon' => $afternoon,
        ]);

        return redirect('service/badminton')->with('message', 'Layanan berhasil diubah');
    }

    public function memberEdit($id)
    {
        $data['member'] = PriceMember::where('id', $id)->where('service_id', 3)->first();

        return view('backend.service.badminton.edit-member', $data);
    }

    public function memberUpdate(Request $request,$id)
    {
        $member = PriceMember::find($id);

        $two_hours_morning = str_replace(['Rp ', '.', ','], ['', '', ''], $request->two_hours_morning);
        $three_hours_morning = str_replace(['Rp ', '.', ','], ['', '', ''], $request->three_hours_morning);
        $two_hours_afternoon = str_replace(['Rp ', '.', ','], ['', '', ''], $request->two_hours_afternoon);
        $four_hours_afternoon = str_replace(['Rp ', '.', ','], ['', '', ''], $request->four_hours_afternoon);

        $member->update([
            'two_hours_morning' => $two_hours_morning,
            'three_hours_morning' => $three_hours_morning,
            'two_hours_afternoon' => $two_hours_afternoon,
            'four_hours_afternoon' => $four_hours_afternoon,
        ]);

        return redirect('service/badminton')->with('message', 'Layanan berhasil diubah');
    }
}
