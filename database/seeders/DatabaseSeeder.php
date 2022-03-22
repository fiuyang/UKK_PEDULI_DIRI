<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
            'username' => 'admin',
            'nik' => '038383838383',
            'email' => 'admin@gmail.com',
            'no_telepon' => '0895387117089',
            'password' => bcrypt('password'),
            'role' => 'admin'
            ],
            [
            'username' => 'bayudiarta',
            'nik' => '0383838344448383',
            'email' => 'bayu@gmail.com',
            'no_telepon' => '089538711447089',
            'password' => bcrypt('password'),
            'role' => 'user'
            ]
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
