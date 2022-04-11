<?php

namespace App\Http\Controllers\Api;

use App\Models\Perjalanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Perjalanan as PerjalananResource;

class PerjalananController extends Controller
{
    public function index(Request $request)
    {
        $perjalanans = Perjalanan::all();

        $geoJSONdata = $perjalanans->map(function ($perjalanan) {
            return [
                'type' => 'Feature',
                'properties' => new PerjalananResource($perjalanan),
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [
                        $perjalanan->longitude,
                        $perjalanan->latitude,

                    ],
                ],
            ];
        });

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $geoJSONdata,
        ]);
    }
}
