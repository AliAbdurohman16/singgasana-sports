<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();

        return view('backend.setting.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'mimes:jpg,png,jpeg,webp|image|max:2048',
            'favicon' => 'mimes:jpg,png,jpeg,webp|image|max:2048',
            'visitors' => 'required',
            'event' => 'required',
            'venue' => 'required',
            'ppn' => 'required',
            'telephone1' => 'required|max:15',
            'telephone2' => 'max:15',
            'email' => 'required|email',
            'address1' => 'required',
        ]);

        $setting = Setting::find(1);

        if ($request->hasFile('logo')) {
            Storage::delete('public/setting/' . $setting->logo);
            $logoPath = $request->file('logo')->store('public/setting');
            $logoName = basename($logoPath);
        } else {
            $logoName = $setting->logo;
        }

        if ($request->hasFile('favicon')) {
            Storage::delete('public/setting/' . $setting->favicon);
            $faviconPath = $request->file('favicon')->store('public/setting');
            $faviconName = basename($faviconPath);
        } else {
            $faviconName = $setting->favicon;
        }

        $setting->update([
            'name' => $request->name,
            'logo' => $logoName,
            'favicon' => $faviconName,
            'visitors' => $request->visitors,
            'event' => $request->event,
            'venue' => $request->venue,
            'ppn' => $request->ppn,
            'telephone1' => $request->telephone1,
            'telephone2' => $request->telephone2,
            'email' => $request->email,
            'address1' => $request->address1,
            'address2' => $request->address2,
        ]);

        return redirect()->back()->with('message', 'Data berhasil diubah!');
    }
}
