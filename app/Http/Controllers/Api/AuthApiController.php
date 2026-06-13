<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Email atau password salah'
        ], 401);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Registrasi berhasil',
            'user' => $user
        ]);
    }
    
    public function updateProfile(Request $request)
{
    $request->validate([
        'id' => 'required|exists:users,id',
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $request->id,
    ]);

    $user = User::findOrFail($request->id);

    $user->name = $request->name;
    $user->email = $request->email;

    $user->save();

    return response()->json([
        'success' => true,
        'message' => 'Profil berhasil diperbarui',
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]
    ]);
}

public function changePassword(Request $request)
{
    $request->validate([
        'id' => 'required|exists:users,id',
        'old_password' => 'required',
        'new_password' => 'required|min:8',
    ]);

    $user = User::findOrFail($request->id);

    if (!Hash::check(
        $request->old_password,
        $user->password
    )) {
        return response()->json([
            'success' => false,
            'message' => 'Password lama salah'
        ]);
    }

    $user->password = bcrypt(
        $request->new_password
    );

    $user->save();

    return response()->json([
        'success' => true,
        'message' => 'Password berhasil diubah'
    ]);
}
}