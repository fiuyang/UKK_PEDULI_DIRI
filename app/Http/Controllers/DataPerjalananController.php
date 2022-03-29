<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPerjalanan;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class DataPerjalananController extends Controller
{
    public function index()
    {
        return view('data_perjalanan.index');
    }
    
    public function get()
    {
        $data = DataPerjalanan::orderBy('id', 'ASC')->where([
            'users_id' => auth()->user()->id
        ]);
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
                $actions = '<button class="btn btn-danger" onclick="destroy(' . $data->id . ')" type="button">Delete</button>';
                return $actions;
            })
            ->rawColumns(['actions'])
            ->addIndexColumn()
            ->make(true);         
    }

    public function destroy($id)
    {
        $data_perjalanan = DataPerjalanan::find($id);
        $data_perjalanan->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Di Hapus',
        ]);
    }
}
