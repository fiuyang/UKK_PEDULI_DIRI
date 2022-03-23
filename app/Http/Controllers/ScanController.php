<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScanController extends Controller
{
    public function index()
    {
        return view('scanner.index');
    }

    public function store(Request $request)
    {
        $scanner = request()->post('scanner');
        if(isset($scanner)) {
            $data = explode(",", $scanner);
            $scan =
            DB::insert(
                "INSERT INTO data_perjalanan (tanggal, jam, lokasi, suhu_tubuh, created_at, updated_at) VALUES (:tanggal, :jam, :lokasi, :suhu_tubuh, :created_at, :updated_at)",
                [
                    'tanggal' => $data[0],
                    'jam' => $data[1],
                    'lokasi' => $data[2],
                    'suhu_tubuh' => $data[3],
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
        if ($scan) {
            return response()->json([
                'status' => true,
                'message' => 'Data Scan Berhasil DiTambahkan', 
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data Scan Gagal DiTambahkan', 
            ]);
        }
    }
}
