<?php

namespace App\Http\Controllers;

use App\Models\Perjalanan;
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
                "INSERT INTO perjalanans (tanggal, jam, lokasi, suhu_tubuh) VALUES (:tanggal, :jam, :lokasi, :suhu_tubuh)",
                [
                    ':tanggal' => $data[0],
                    ':jam' => $data[1],
                    ':lokasi' => $data[2],
                    ':suhu_tubuh' => $data[3]
                ]
            );
        }
        if ($scan) {
            $arr = array('message' => 'Data Scan Berhasil DiTambahkan', 'status' => true);
        }
        return response()->json($arr);
    }
}
