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
            return redirect()->route('home');
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
            'username' => 'required|min:8|max:20',
            'nik'      => 'required|unique:users|min:16|numeric',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ],[
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email harus berupa email',
            'email.unique' => 'Email sudah terdaftar',
            'username.required' => 'Username tidak boleh kosong',
            'username.min' => 'Username minimal 8 karakter',
            'username.max' => 'Username maksimal 20 karakter',
            'nik.required' => 'NIK tidak boleh kosong',
            'nik.unique' => 'NIK sudah terdaftar',
            'nik.numeric' => 'NIK harus berupa angka',
            'nik.min' => 'NIK harus 16 digit',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter'
        ]);

        $user = User::create([
            'username' => $request->username ,
            'nik' => $request->nik,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        if($user) {
            return redirect()->route('login')->with('success', 'Kamu Berhasil Membuat Akun');
            // session()->flash('success', 'Kamu Berhasil Membuat Akun');
        } else {
            session()->flash('errors','Register gagal! Silahkan ulangi beberapa saat lagi');
            return redirect()->route('register');
        }
    }
}
