<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class OfficerController extends Controller
{
    public function index()
    {
        // get data only roles admin or cashier
        $officers = User::whereHas('roles', function ($query) {
                    $query->where('name', '!=', 'superadmin')->where('name', '=', 'admin')->orWhere('name', '=', 'cashier');
                })->get();

        return view('backend.officer.index', compact('officers'));
    }

    public function create()
    {
        return view('backend.officer.add');
    }

    public function store(Request $request)
    {
        // validation
        $request->validate([
            'image' => 'required|mimes:jpg,png,jpeg|image|max:2048',
            'first_name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'telephone' => 'required|max:15',
            'password' => 'required|min:8|confirmed',
            'role' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/profile');
            $imageName = basename($imagePath);
        } else {
            $imageName = '';
        }

        // insert to table users
        $officers = User::create([
            'image' => $imageName,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'password' => Hash::make($request->password),
        ]);

        // assign role
        $officers->assignRole($request->role);

        return redirect('officers')->with('message', 'Data petugas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $officer = User::find($id);

        return view('backend.officer.edit', compact('officer'));
    }

    public function update(Request $request,$id)
    {
        // get data by id
        $officer = User::find($id);

        if ($request->hasFile('image')) {
            Storage::delete('public/profile/' . $officer->image);
            $imagePath = $request->file('image')->store('public/profile');
            $imageName = basename($imagePath);
        } else {
            $imageName = $officer->image;
        }

        // check if email unique the officer email
        if ($officer->email == $request->email) {
            $rules_email = 'required|email';
        } else {
            $rules_email = 'required|email|unique:officers';
        }

        // check if the officer password
        if ($request->password) {
            $rules_password = 'required|min:8|confirmed';
        } else {
            $rules_password = '';
        }

        // validation
        $request->validate([
            'image' => 'mimes:jpg,png,jpeg|image|max:2048',
            'first_name' => 'required|max:255',
            'email' => $rules_email,
            'telephone' => 'required|max:15',
            'password' => $rules_password,
        ]);

        // update to table officers
        $officer->update([
            'image' => $imageName,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'password' => $request->password ? Hash::make($request->password) : $officer->password,
        ]);

        return redirect('officers')->with('message', 'Data petugas berhasil diubah.');
    }

    public function destroy($id)
    {
        // proccess delete
        $officer = User::find($id);

        if ($officer->image) {
            Storage::delete('public/profile/' . $officer->image);
        }

        $officer->delete();

        return response()->json(['message' => 'Data berhasil dihapus.']);
    }
}
