<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'admin',
            'nik' => '038383838383',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
