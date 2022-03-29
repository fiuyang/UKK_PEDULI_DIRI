<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        if(Auth::check()) {
            return redirect()->back();
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'no_telepon' => 'required',
            'password' => 'required',
        ],[
            'no_telepon.required' => 'No Telepon tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ]);

        $data = [
            'no_telepon' => $request->no_telepon,
            'password' => $request->password,
        ];

        $fieldType = filter_var($request->no_telepon, FILTER_VALIDATE_EMAIL) ? 'email' : 'no_telepon';


        if (Auth::check()) {
            return redirect()->back();
        }
        if (Auth::attempt(array($fieldType => $data['no_telepon'], 'password' => $data['password']))){
            return redirect()->route('dashboard');
        } else {
            return redirect(('login'))->with('error', 'no telepon atau email atau password salah!!');
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
            'no_telepon' => ['required', 'regex:/^(^\+62|62|^08)(\d{3,4}-?){2}\d{3,4}$/', 'unique:users', 'min:11', 'max:13'],
            'avatar' => 'required|mimes:jpeg,jpg,png' 
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
            'password.min' => 'Password minimal 8 karakter',
            'no_telepon.required' => 'No Telepon tidak kosong',
            'no_telepon.regex' => 'No Telepon tidak valid',
            'no_telepon.min' => 'No Telepon minimal 11 digit',
            'no_telepon.max' => 'No Telepon maximal 13 digit',
            'avatar.required' => 'Avatar tidak boleh kosong',
            'avatar.mimes' => 'Avatar harus berupa jpeg, jpg, atau png'
        ]);

        if ($request->hasFile("avatar")) {
            $file = $request->file("avatar");
            $filename = time() . "." . $file->getClientOriginalExtension();
            $file->move('assets/images', $filename);
        }

        $user = User::create([
            'username' => $request->username ,
            'nik' => $request->nik,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'password' => bcrypt($request->password),
            'avatar' => $filename,
            'role' => 'user',
        ]);
        if($user) {
            return redirect(route('login'))->with('success', 'Kamu Berhasil Membuat Akun');
            // session()->flash('success', 'Kamu Berhasil Membuat Akun');
        } else {
            session()->flash('errors','Register gagal! Silahkan ulangi beberapa saat lagi');
            return redirect()->route('register');
        }
    }
}
