<?php

namespace App\Http\Controllers;

use App\Models\Perjalanan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PerjalananController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('perjalanan.index');
    }

    public function get()
    {
        $data = Perjalanan::orderBy('id', 'ASC');
        return DataTables::of($data)
            ->addColumn('actions', function ($data) {
                return '<a href="'. route('perjalanan.edit', $data->id) . '" class="btn btn-info">Edit</a>
                        <button class="btn btn-danger" onclick="deleteConfirmation('.$data->id.')" type="button">Delete</button>';
                
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'jam' => 'required',
            'lokasi' => 'required',
            'suhu_tubuh' => 'required|numeric',
        ], [
            'tanggal.required' => 'Tanggal Wajib Di Isi',
            'jam.required' => 'Waktu Perjalanan Wajib Di Isi',
            'lokasi.required' => 'Lokasi Perjalanan Wajib Di Isi',
            'suhu_tubuh.required' => 'Suhu Tubuh Wajib Di Isi',
            'suhu_tubuh.numeric' => 'Suhu Tubuh Wajib Angka',
        ]);

        $data = [
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'lokasi' => $request->lokasi,
            'suhu_tubuh' => is_double($request->suhu_tubuh) ? $request->suhu_tubuh : doubleval($request->suhu_tubuh),
        ];

        $perjalanan = Perjalanan::create($data);
        if ($perjalanan) {
            return redirect()->route('perjalanan.index')->with('success', 'Data Berhasil Di Tambahkan');
        } else {
            return back()->with('error', 'Data Gagal Di Tambahkan');
        }
    }  

    public function create()
    {
        return view('perjalanan.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perjalanan  $perjalanan
     * @return \Illuminate\Http\Response
     */
    public function show(Perjalanan $perjalanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perjalanan  $perjalanan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $perjalanan = Perjalanan::findOrFail($id);
        return view('perjalanan.edit', compact('perjalanan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Htt public function destroy($id)
     * @param  \App\Models\Perjalanan  $perjalanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required',
            'jam' => 'required',
            'lokasi' => 'required',
            'suhu_tubuh' => 'required',
        ], [
            'tanggal.required' => 'Tanggal Wajib Di Isi',
            'jam.required' => 'Waktu Perjalanan Wajib Di Isi',
            'lokasi.required' => 'Lokasi Perjalanan Wajib Di Isi',
            'suhu_tubuh.required' => 'Suhu Tubuh Wajib Di Isi',
        ]);

        $data = [
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'lokasi' => $request->lokasi,
            'suhu_tubuh' => $request->suhu_tubuh,
        ];

        $perjalanan = Perjalanan::findOrFail($id);
        $perjalanan->update($data);

        if($perjalanan) {
            return redirect()->route('perjalanan.index')->with('success', 'Data Berhasil Di Update');
        }else {
            return back()->with('error', 'Data Gagal Di Update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perjalanan  $perjalanan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perjalanan = Perjalanan::find($id);
        $perjalanan->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Di Hapus',
        ]);
    }
}
