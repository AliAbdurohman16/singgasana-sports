<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ResponseFormatter;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => 'max:255',
            'telephone' => 'required|max:15',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error($validator->errors(), 'Validation Error', 422);
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password)
        ]);

        $user->assignRole('user');

        return ResponseFormatter::success(['user' => $user], 'Register has been successfully!');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])
                    ->whereNotNull('email_verified_at')
                    ->first();

        if (!$user || !Auth::attempt($credentials)) {
            return ResponseFormatter::error([
                'message' => 'Unauthorized'
            ], 'Unauthorized', 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        if (!$user->hasRole('user')) {
            Auth::logout();
            return ResponseFormatter::error([
                'message' => 'Unauthorized'
            ], 'Unauthorized', 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return ResponseFormatter::success([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 'Login has been successfully!');
    }

    public function logout()
    {
        $user = Auth::user();

        if ($user) {
            $user->tokens()->delete();
        }

        return ResponseFormatter::success(['user' => $user], 'Logout has been successfully!');
    }
}
