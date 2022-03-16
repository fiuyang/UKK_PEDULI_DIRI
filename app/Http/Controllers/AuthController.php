<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check() == true) {
            return redirect()->back();
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        if (Auth::check() == true) {
            return redirect()->back();
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('perjalanan.index');
        } else {
            return redirect()->route('login')->with('error', 'email atau password salah!!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'nik'      => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'username' => $request->username ,
            'nik' => $request->nik,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        session()->flash('message', 'Kamu Berhasil Membuat Akun');
        return redirect()->route('login');
    }
}
