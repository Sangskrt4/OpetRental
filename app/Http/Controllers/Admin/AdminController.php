<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function profil()
    {
        $user = auth()->user();
        return view('admin.profil', compact('user'));
    }

    public function updateProfil(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_wa' => 'required',
            'alamat' => 'required',
            'current_password' => 'nullable|min:8',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_wa = $request->no_wa;
        $user->alamat = $request->alamat;

        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password lama tidak sesuai']);
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->route('admin.profil')->with('success', 'Profil berhasil diperbarui');
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = auth()->user();

        if ($user->foto_profil) {
            Storage::disk('public')->delete($user->foto_profil);
        }

        $path = $request->file('photo')->store('profil', 'public');
        $user->foto_profil = $path;
        $user->save();

        return redirect()->route('admin.profil')->with('success', 'Foto profil berhasil diperbarui');
    }

    // Data User (CRUD)
    public function dataUser()
    {
        $users = User::where('role', 'user')->orderBy('created_at', 'desc')->get();
        return view('admin.data-user.index', compact('users'));
    }

    public function createUser()
    {
        return view('admin.data-user.create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'no_wa' => 'required',
            'alamat' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_wa' => $request->no_wa,
            'alamat' => $request->alamat,
            'role' => 'user',
        ]);

        return redirect()->route('admin.data-user')->with('success', 'User berhasil ditambahkan');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.data-user.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'no_wa' => 'required',
            'alamat' => 'required',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'no_wa' => $request->no_wa,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.data-user')->with('success', 'User berhasil diperbarui');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.data-user')->with('success', 'User berhasil dihapus');
    }
}