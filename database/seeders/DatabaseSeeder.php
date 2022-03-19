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
            'no_telepon' => '0895387117089',
            'password' => bcrypt('password'),
            'level' => 'admin'
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
