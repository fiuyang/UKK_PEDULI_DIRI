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
        $data = DataPerjalanan::orderBy('id', 'ASC');
        return DataTables::of($data)
            ->addColumn('tanggal', function ($request) {
                $date = Carbon::createFromFormat('Y-m-d', $request->tanggal)->format('d-m-Y');
                return $date;
            })
            ->addColumn('jam', function ($request) {
                $time = Carbon::createFromFormat('H:i:s', $request->jam)->format('H:i');
                return $time;
            })
            ->addIndexColumn()
            ->make(true);
    }
}
