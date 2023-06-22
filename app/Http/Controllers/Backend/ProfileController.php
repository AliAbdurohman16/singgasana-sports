<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Auth::user();

        return view('backend.account.profile.index', compact('profile'));
    }

    public function store(Request $request)
    {
        $profile = Auth::user();

        if ($profile->email == $request->email) {
            $rules = 'required|email';
        } else {
            $rules = 'required|email|unique:users';
        }

        $request->validate([
            'image' => 'mimes:jpg,png,jpeg|image|max:2048',
            'name' => 'required',
            'email' => $rules,
            'telephone' => 'required|min:10|max:13',
            'address' => 'required|max:255',

        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/profile');

            if ($profile->image != 'backend/assets/images/faces/2.jpg') {
                Storage::delete('public/profile/' . $profile->image);
                $imageName = basename($imagePath);
            }

            $imageName = basename($imagePath);
        } else {
            $imageName = $profile->image;
        }

        $profile->update([
            'image' => $imageName,
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'address' => $request->address,
        ]);

        return redirect()->back()->with('message', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $profile = Auth::user();
        if ($profile->image) {
            Storage::delete('public/profile/' . $profile->image);
        }

        $profile->update([
            'image' => 'backend/assets/images/faces/2.jpg',
        ]);

        return redirect()->back()->with(['message' => 'Data berhasil dihapus!']);
    }
}
