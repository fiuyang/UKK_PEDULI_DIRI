<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index()
    {
        $logs = Log::with(['users'])->where(['users_id' => auth()->user()->id])->get();
        return view('log.index', compact('logs'));
    }

    public function destroy($id)
    {
        $log = Log::findOrFail($id);
        $log->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Di Hapus',
        ]);
    }
}
