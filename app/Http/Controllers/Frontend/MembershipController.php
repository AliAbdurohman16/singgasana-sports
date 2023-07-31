<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Memberships;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;

class MembershipController extends Controller
{
    public function index()
    {
        return view('frontend.membership.index');
    }

    public function storePersonal(Request $request)
    {


        $personalMembership = $request->validate([
            'nama_lengkap' => 'required',
            'tipe_membership' => 'required',
            'email' => 'required|email:dns',
            'notelp' => 'required|numeric',
            'booking_until' => 'required',
            'alamat' => 'required'
        ]);

        Memberships::create($personalMembership);
        $data = [
            'order_id' => 'ORD20293092030',
            // Insert other data here
        ];
        Mail::to($request->email)->send(new InvoiceMail($data));
        return redirect('/')->with('message', 'Data Berhasil Dikirim. Silahkan Lihat Email Konfirmasi');
    }

    public function storeCouple(Request $request)
    {
        $coupleMembership = $request->validate([
            'nama_lengkap' => 'required',
            'nama_penanggung' => 'required',
            'tipe_membership' => 'required',
            'email' => 'required|email:dns',
            'notelp' => 'required|numeric',
            'booking_until' => 'required',
            'alamat' => 'required',
        ]);

        Memberships::create($coupleMembership);
        return redirect('/')->with('message', 'Data Berhasil Dikirim. Silahkan Lihat Email Konfirmasi');
    }

    public function storeTriple(Request $request)
    {
        $tripleMembership = $request->validate([
            'nama_lengkap' => 'required',
            'nama_penanggung' => 'required',
            'tipe_membership' => 'required',
            'email' => 'required|email:dns',
            'notelp' => 'required|numeric',
            'booking_until' => 'required',
            'alamat' => 'required',
            'csv' => 'required|file|mimes:csv'
        ]);

        if ($request->hasFile('csv')) {
            $tripleMembership['csv'] = $request->file('csv')->store('data');
        }

        Memberships::create($tripleMembership);
        return redirect('/')->with('message', 'Data Berhasil Dikirim. Silahkan Lihat Email Konfirmasi');
    }

    public function storeFamily(Request $request)
    {
        $familyMembership = $request->validate([
            'nama_lengkap' => 'required',
            'nama_penanggung' => 'required',
            'tipe_membership' => 'required',
            'email' => 'required|email:dns',
            'notelp' => 'required|numeric',
            'booking_until' => 'required',
            'alamat' => 'required',
            'csv' => 'required|file|mimes:csv'
        ]);

        Memberships::create($familyMembership);
        return redirect()->route('/');
    }

    public function storeStudent(Request $request)
    {
        $studentMembership = $request->validate([
            'nama_lengkap' => 'required',
            'nama_penanggung' => 'required',
            'tipe_membership' => 'required',
            'email' => 'required|email:dns',
            'notelp' => 'required|numeric',
            'booking_until' => 'required',
            'alamat' => 'required',
            'csv' => 'required|file|mimes:csv'
        ]);

        Memberships::create($studentMembership);
        return redirect('/')->with('message', 'Data Berhasil Dikirim. Silahkan Lihat Email Konfirmasi');
    }

    public function storeCommunity(Request $request)
    {
        $communityMembership = $request->validate([
            'nama_lengkap' => 'required',
            'nama_penanggung' => 'required',
            'tipe_membership' => 'required',
            'email' => 'required|email:dns',
            'notelp' => 'required|numeric',
            'booking_until' => 'required',
            'alamat' => 'required',
            'csv' => 'required|file|mimes:csv'
        ]);

        Memberships::create($communityMembership);
        return redirect('/')->with('message', 'Data Berhasil Dikirim. Silahkan Lihat Email Konfirmasi');
    }
}
