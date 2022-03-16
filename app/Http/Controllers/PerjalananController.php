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
        $data = Perjalanan::latest();
        return DataTables::of($data)
            ->addColumn('actions', function ($data) {
                return '<button type="button" class="btn btn-success btn-sm" id="edit-perjalanan" data-id="'.$data->id. '">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="destroy(' . $data->id . ')">Delete</button>';
                
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
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'jam' => 'required',
            'lokasi' => 'required',
            'suhu_tubuh' => 'required',
        ],[
            'tanggal.required' => 'Tanggal Wajib Di Isi',
            'jam.required' => 'Waktu Perjalanan Wajib Di Isi',
            'lokasi.required' => 'Lokasi Perjalanan Wajib Di Isi',
            'suhu_tubuh.required' => 'Suhu Tubuh Wajib Di Isi',
        ]);

        if (!$validator->passes()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        
        $data = [
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'lokasi' => $request->lokasi,
            'suhu_tubuh' => $request->suhu_tubuh,
        ];

        $perjalanan = Perjalanan::create($data);
        return response()->json([
            'success' => 'Data Berhasil Ditambahkan',
            'data' => $perjalanan
        ],200);
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perjalanan  $perjalanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perjalanan $perjalanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perjalanan  $perjalanan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
