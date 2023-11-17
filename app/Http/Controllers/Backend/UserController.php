<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // get data only roles user
        $users = User::whereHas('roles', function ($query) {
                    $query->where('name', '=', 'user');
                })->get();

        return view('backend.user.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('backend.user.edit', compact('user'));
    }

    public function update(Request $request,$id)
    {
        // get data by id
        $user = User::find($id);

        // check if email unique the user email
        if ($user->email == $request->email) {
            $rules_email = 'required|email';
        } else {
            $rules_email = 'required|email|unique:users';
        }

        // check if the user password
        if ($request->password) {
            $rules_password = 'required|min:8|confirmed';
        } else {
            $rules_password = '';
        }

        // validation
        $request->validate([
            'first_name' => 'required|max:255',
            'email' => $rules_email,
            'telephone' => 'required|max:15',
            'password' => $rules_password,
        ]);

        // update to table users
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect('users')->with('message', 'Data pengguna berhasil diubah.');
    }

    public function destroy($id)
    {
        // proccess delete
        $user = User::find($id);
        $user->delete();

        return response()->json(['message' => 'Data berhasil dihapus.']);
    }
}
