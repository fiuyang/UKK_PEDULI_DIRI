<?php

use App\Models\User;
use App\Models\Perjalanan;
use Faker\Generator as Faker;

$factory->define(Perjalanan::class, function (Faker $faker) {
    $mapCenterLatitude = config('leaflet.map_center_latitude');
    $mapCenterLongitude = config('leaflet.map_center_longitude');
    $minLatitude = $mapCenterLatitude - 0.05;
    $maxLatitude = $mapCenterLatitude + 0.05;
    $minLongitude = $mapCenterLongitude - 0.07;
    $maxLongitude = $mapCenterLongitude + 0.07;

    return [
        'tanggal'    => $faker->date('Y-m-d'),
        'jam'        => $faker->time('H:i:s'),
        'lokasi'     => $faker->address,
        'suhu_tubuh' => $faker->randomFloat(2, 30, 40),
        'latitude'   => $faker->latitude($minLatitude, $maxLatitude),
        'longitude'  => $faker->longitude($minLongitude, $maxLongitude),
        'users_id' => function () {
            return factory(User::class)->create()->id;
        },
    ];
});
