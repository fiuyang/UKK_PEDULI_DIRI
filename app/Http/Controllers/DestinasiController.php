<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Destinasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DestinasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('destinasi.index');
    }

    public function get()
    {
        $data = Destinasi::orderBy('id', 'ASC')->where(['users_id' => auth()->user()->id]);
        return DataTables::of($data)
            ->addColumn('actions', function ($data) {
                $actions = "";
                if (Auth::user()->role == 'admin') {
                    $actions = '<a href="' . route('destinasi.edit', $data->id) . '" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-danger" onclick="destroy(' . $data->id . ')" type="button"><i class="fa fa-trash"></i></button>
                                <a href="' . route('qrcode',  $data->id) . '" class="btn btn-info"><i class="fas fa-qrcode"></i></a>';
                }
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

    public function create()
    {
        return view('destinasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_destinasi' => 'required',
            'lokasi_destinasi' => 'required'
        ], [
            'nama_destinasi.required' => 'Nama Destinasi Wajib Di Isi',
            'lokasi_destinasi.required' => 'Lokasi Destinasi Wajib Di Isi'
        ]);

        $data = [
            'users_id' => auth()->user()->id,
            'nama_destinasi' => $request->nama_destinasi,
            'lokasi_destinasi' => $request->lokasi_destinasi
        ];

        $destinasi = Destinasi::create($data);
        if ($destinasi) {
            return redirect()->route('destinasi.index')->with('success', 'Data Berhasil Di Tambahkan');
        } else {
            return back()->with('error', 'Data Gagal Di Tambahkan');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Destinasi  $destinasi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $destinasi = Destinasi::findOrFail($id);
        return view('destinasi.edit', compact('destinasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Htt public function destroy($id)
     * @param  \App\Models\Destinasi  $destinasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_destinasi' => 'required',
            'lokasi_destinasi' => 'required'
        ], [
            'nama_destinasi.required' => 'Nama Destinasi Wajib Di Isi',
            'lokasi_destinasi.required' => 'Lokasi Destinasi Wajib Di Isi'
        ]);

        $data = [
            'users_id' => auth()->user()->id,
            'nama_destinasi' => $request->nama_destinasi,
            'lokasi_destinasi' => $request->lokasi_destinasi
        ];

        $destinasi = Destinasi::findOrFail($id);
        $destinasi->update($data);

        if ($destinasi) {
            return redirect()->route('destinasi.index')->with('success', 'Data Berhasil Di Update');
        } else {
            return back()->with('error', 'Data Gagal Di Update');
        }
    }

    public function qrcode($id)
    {
        $destinasi = Destinasi::findOrFail($id);
        if ($destinasi) {
            $qrcode = QrCode::size(400)->errorCorrection('H')
                ->generate($destinasi['lokasi_destinasi']);
            $filename = time() . '.png';
            $output_file = '/img/qrcode/qr-' . $filename;
            $data['qrcode'] = $filename;
            $destinasi->update($data);
            Storage::disk('local')->put($output_file, $qrcode);
        }
        return view('qrcode', compact('qrcode'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Destinasi  $perjalanan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destinasi = Destinasi::findOrFail($id);
        $destinasi->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Di Hapus',
        ]);
    }
}
