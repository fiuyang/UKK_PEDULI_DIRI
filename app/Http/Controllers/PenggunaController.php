<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PenggunaController extends Controller
{
    public function index()
    {
        return view('pengguna.index', ['title' => 'Pengguna']);
    }

    public function get()
    {
        $data = User::orderBy('id', 'ASC')->where(['role' => 'admin']);
        return DataTables::of($data)
            ->addColumn('actions', function ($data) {
                $actions = "";
                if (Auth::user()->role == 'admin') {
                    $actions = '<a href="' . route('pengguna.edit', $data->id) . '" class="btn btn-info">Edit</a>
                                <button class="btn btn-danger" onclick="destroy(' . $data->id . ')" type="button">Delete</button>';
                }  
                return $actions;
            })
            ->rawColumns(['actions'])
            ->addIndexColumn()
            ->make(true);
    }

    public function create()
    {
        return view('pengguna.create');
    }

    public function edit($id)
    {
        $pengguna = User::findOrFail($id);
        return view('pengguna.edit', compact('pengguna'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|min:8|max:20',
            'nik'      => 'required|unique:users|min:16|numeric',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'no_telepon' => ['required', 'regex:/^(^\+62|62|^08)(\d{3,4}-?){2}\d{3,4}$/', 'unique:users', 'min:11', 'max:13'],
            'avatar' => 'required|mimes:jpeg,jpg,png' 
        ], [
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

        $pengguna = User::create([
            'username' => $request->username,
            'nik' => $request->nik,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'password' => bcrypt($request->password),
            'avatar' => $filename,
            'role' => 'admin',
        ]);
        if ($pengguna) {
            return redirect()->route('pengguna.index')->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->route('pengguna.index')->with('errors', 'Data berhasil ditambahkan');
        }
    }

    public function update(Request $request, $id)
    {
        $pengguna = User::find($id);
        $this->validate($request, [
            'username' => 'required|min:8|max:20',
            'nik' => 'required|unique:users,nik,' . $pengguna->id . '|min:16|numeric',
            'email' => 'required|email|unique:users,email,' . $pengguna->id,
            'password' => 'required|min:8',
            'no_telepon' => ['required', 'regex:/^(^\+62|62|^08)(\d{3,4}-?){2}\d{3,4}$/', 'min:11', 'max:13', 'unique:users,no_telepon,' . $pengguna->id],
            'avatar' => 'required|mimes:jpeg,jpg,png' 
        ],[
            'username.required' => 'Username tidak boleh kosong',
            'username.min' => 'Username minimal 8 karakter',
            'username.max' => 'Username maksimal 20 karakter',
            'nik.required' => 'NIK tidak boleh kosong',
            'nik.min' => 'NIK harus 16 digit',
            'email.required' => 'Email tidak boleh kosong',
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
        $pengguna = $pengguna->update([
            'username' => $request->username,
            'nik' => $request->nik,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'password' => bcrypt($request->password),
            'avatar' => $filename,
            'role' => 'admin',
        ]);
        // dd($pengguna);
        if ($pengguna) {
            return redirect()->route('pengguna.index')->with('success', 'Data berhasil diubah');
        } else {
            return redirect()->route('pengguna.index')->with('errors', 'Data berhasil diubah');
        }
    }

    public function destroy($id)
    {
        $pengguna = User::find($id);
        $pengguna->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Di Hapus',
        ]);
    }
}
