<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail($id);
        return view('user.profile', compact('user'));
    }

    public function profile(Request $request, $id)
    {
        $user = User::findOrfail($id);
        if ($request->hasFile('avatar')) {
            $filename = $request->avatar->getClientOriginalName();
            $request->avatar->storeAs('images', $filename, 'public');
        }
        $request->validate([
            'username' => 'required',
            'email' => 'required:users,email,id,' . $id,
            'avatar' => 'required|mimes:jpeg,jpg,png',
            'password' => 'required',
        ],[
            'username.required' => 'Username tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'avatar.required' => 'Avatar tidak boleh kosong',
            'avatar.mimes' => 'Avatar harus berupa jpeg, jpg, atau png',
            'password.required' => 'Password tidak boleh kosong',
        ]);
        if (Hash::check($request->password, $user->password)) {
            $user->update([
                'username' => $request->username,
                'email' => $request->email,
                'avatar' => $filename
            ]);
            return back()->with('success', 'Profil berhasil diubah');
        } else {
            return back()->with('error', 'Password Anda tidak sesuai');
        }
    }

    public function password()
    {
        $user = User::findOrfail(auth()->user()->id);
        return view('user.changePassword', compact('user'));
    }

    public function changePassword(Request $request, $id)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|same:confirm-password',
        ],[
            'current_password.required' => 'Password lama tidak boleh kosong',
            'new_password.required' => 'Password baru tidak boleh kosong',
            'new_password.min' => 'Password baru minimal 8 karakter',
            'new_password.same' => 'Password baru tidak sama dengan konfirmasi password',
        ]);
        $user = User::findOrfail($id);
        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);
            return back()->with('success', 'Password berhasil diubah');
        } else {
            return back()->with('error', 'Password lama Anda tidak sesuai');
        }
    }
}
