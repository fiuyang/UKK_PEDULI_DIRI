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
        $post = request()->post();
        if (isset($post)) {
            $model = DB::insert(
                "INSERT INTO perjalanans (users_id, tanggal, jam, lokasi, suhu_tubuh, created_at, updated_at) VALUES (:users_id, :tanggal, :jam, :lokasi, :suhu_tubuh, :created_at, :updated_at)",
                [
                    'users_id' => auth()->user()->id,
                    'tanggal' => date('Y-m-d'),
                    'jam' => date('H:i:s'),
                    'lokasi' => $post['lokasi'],
                    'suhu_tubuh' => $post['suhu_tubuh'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
        if ($model) {
            return response()->json([
                'status' => true,
                'message' => 'Data Scan Berhasil DiTambahkan'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data Scan Gagal DiTambahkan'
            ]);
        }
    }
}
