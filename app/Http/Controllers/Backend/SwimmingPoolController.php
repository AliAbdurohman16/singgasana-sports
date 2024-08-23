<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\PriceDaily;
use App\Models\PriceMember;

class SwimmingPoolController extends Controller
{
    public function index()
    {
        $data = [
            'dailies' => PriceDaily::where('service_id', 1)->get(),
            'members' => PriceMember::where('service_id', 1)->where('member', '!=', 'Sekolah')->get(),
            'schools' => PriceMember::where('member', 'Sekolah')->get()
        ];

        return view('backend.service.swimming-pool.index', $data);
    }

    public function dailyEdit($id)
    {
        $data['daily'] = PriceDaily::where('id', $id)->where('service_id', 1)->first();

        return view('backend.service.swimming-pool.edit-daily', $data);
    }

    public function dailyUpdate(Request $request,$id)
    {
        $request->validate([
            'weekday' => 'required',
        ]);

        $daily = PriceDaily::find($id);

        $weekday = str_replace(['Rp ', '.', ','], ['', '', ''], $request->weekday);
        $weekend = $request->weekend != null ? str_replace(['Rp ', '.', ','], ['', '', ''], $request->weekend) : $request->weekend;

        $daily->update([
            'weekday' => $weekday,
            'weekend' => $weekend,
        ]);

        return redirect('service/swimming-pool')->with('message', 'Layanan berhasil diubah');
    }

    public function memberEdit($id)
    {
        $data['member'] = PriceMember::where('id', $id)->where('service_id', 1)->first();

        return view('backend.service.swimming-pool.edit-member', $data);
    }

    public function memberUpdate(Request $request,$id)
    {
        $member = PriceMember::find($id);

        $two_months = $request->two_months != null ? str_replace(['Rp ', '.', ','], ['', '', ''], $request->two_months) : $request->two_months;
        $six_months = $request->six_months != null ? str_replace(['Rp ', '.', ','], ['', '', ''], $request->six_months) : $request->six_months;
        $twelve_months = $request->twelve_months != null ? str_replace(['Rp ', '.', ','], ['', '', ''], $request->twelve_months) : $request->twelve_months;
        $package_a = $request->package_a != null ? str_replace(['Rp ', '.', ','], ['', '', ''], $request->package_a) : $request->package_a;
        $package_b = $request->package_b != null ? str_replace(['Rp ', '.', ','], ['', '', ''], $request->package_b) : $request->package_b;
        $package_c = $request->package_c != null ? str_replace(['Rp ', '.', ','], ['', '', ''], $request->package_c) : $request->package_c;
        $package_d = $request->package_d != null ? str_replace(['Rp ', '.', ','], ['', '', ''], $request->package_d) : $request->package_d;
        $two_months_ten_people = $request->two_months_ten_people != null ? str_replace(['Rp ', '.', ','], ['', '', ''], $request->two_months_ten_people) : $request->two_months_ten_people;
        $six_months_ten_people = $request->six_months_ten_people != null ? str_replace(['Rp ', '.', ','], ['', '', ''], $request->six_months_ten_people) : $request->six_months_ten_people;
        $member_coach_club_two_months = $request->member_coach_club_two_months != null ? str_replace(['Rp ', '.', ','], ['', '', ''], $request->member_coach_club_two_months) : $request->member_coach_club_two_months;
        $member_coach_club_two_months_plus_fitness = $request->member_coach_club_two_months_plus_fitness != null ? str_replace(['Rp ', '.', ','], ['', '', ''], $request->member_coach_club_two_months_plus_fitness) : $request->member_coach_club_two_months_plus_fitness;

        $member->update([
            'two_months' => $two_months,
            'six_months' => $six_months,
            'twelve_months' => $twelve_months,
            'package_a' => $package_a,
            'package_b' => $package_b,
            'package_c' => $package_c,
            'package_d' => $package_d,
            'two_months_ten_people' => $two_months_ten_people,
            'six_months_ten_people' => $six_months_ten_people,
            'member_coach_club_two_months' => $member_coach_club_two_months,
            'member_coach_club_two_months_plus_fitness' => $member_coach_club_two_months_plus_fitness,
        ]);

        return redirect('service/swimming-pool')->with('message', 'Layanan berhasil diubah');
    }

    public function schoolCreate()
    {
        return view('backend.service.swimming-pool.create-school');
    }

    public function schoolStore(Request $request)
    {
        PriceMember::create([
            "service_id" => 1,
            "member" => "Sekolah",
            "category" => $request->school,
            "price" => str_replace(['Rp ', '.', ','], ['', '', ''], $request->price),
        ]);

        return redirect('service/swimming-pool')->with('message', 'Data sekolah berhasil disimpan!');
    }

    public function schoolEdit($id)
    {
        $data['school'] = PriceMember::where('id', $id)->where('member', 'Sekolah')->first();

        return view('backend.service.swimming-pool.edit-school', $data);
    }

    public function schoolUpdate(Request $request,$id)
    {
        $school = PriceMember::find($id);

        $school->update([
            "category" => $request->school,
            "price" => str_replace(['Rp ', '.', ','], ['', '', ''], $request->price),
        ]);

        return redirect('service/swimming-pool')->with('message', 'Data sekolah berhasil diubah!');
    }

    public function schoolDestroy($id)
    {
        $school = PriceMember::find($id);

        $school->delete();

        return response()->json(["message" => 'Data sekolah berhasil dihapus!']);
    }
}
