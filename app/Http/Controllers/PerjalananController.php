<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Perjalanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PerjalananController extends Controller
{
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
            ->addColumn('tanggal', function ($request) {
                $date = Carbon::createFromFormat('Y-m-d', $request->tanggal)->format('d-m-Y');
                return $date; 
            })
            ->addColumn('jam', function ($request) {
                $time = Carbon::createFromFormat('H:i:s', $request->jam)->format('H:i');
                return $time;
            })
            ->addColumn('actions', function ($data) {
                $actions = "";
                if (Auth::user()->role == 'admin') {
                    $actions = '<a href="' . route('perjalanan.edit', $data->id) . '" class="btn btn-info">Edit</a>
                                <button class="btn btn-danger" onclick="destroy(' . $data->id . ')" type="button">Delete</button>
                                <a href="' . route('generate', $data->id) . '" class="btn btn-primary">Generate</a>
                                <a href="' . route('qrcode',  $data->id) . '" class="btn btn-info">QrCode</a>';
                } 
                // if(Auth::user()->role == 'user') {
                //     $actions = '<a href="' . route('qrcode',  $data->id) . '" class="btn btn-info">QrCode</a>';
                // }    
                return $actions;
                
            })
            ->rawColumns(['actions'])
            ->addIndexColumn()
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
            'jam' => preg_replace("/[^0-9]/", "", $request->jam),
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

    public function generate($id)
    {
        $data = Perjalanan::findOrFail($id);
        $qrcode = QrCode::size(400)->errorCorrection('H')
                ->generate($data['tanggal'] . ',' . $data['jam'] . ',' . $data['lokasi'] . ',' . $data['suhu_tubuh']);
        $output_file = '/img/qr-code/img-' . time() . '.png';
        Storage::disk('local')->put($output_file, $qrcode); 
        return view('qrcode', compact('data','qrcode'));
    }

    public function qrcode($id)
    {
        $data = Perjalanan::findOrFail($id);
        $pecah = explode(",", $data);
        $qrcode = QrCode::size(400)->errorCorrection('H')
            ->generate($data['tanggal'] . ',' . $data['jam'] . ',' . $data['lokasi'] . ',' . $data['suhu_tubuh']);
        return view('qrcode', compact('data', 'qrcode'));
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
            'jam' => preg_replace("/[^0-9]/", "", $request->jam),
            'lokasi' => $request->lokasi,
            'suhu_tubuh' => is_double($request->suhu_tubuh) ? $request->suhu_tubuh : doubleval($request->suhu_tubuh),
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
