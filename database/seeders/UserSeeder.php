<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $array = [
            ['name' => 'Antonio Mora', 'email' => 'antonio@cloudcoderlabs.com', 'password' => Hash::make('12345678'), 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Antonio Mora', 'email' => 'oscar@cloudcoderlabs.com',   'password' => Hash::make('12345678'),   'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Antonio Mora', 'email' => 'angel@cloudcoderlabs.com',   'password' => Hash::make('12345678'),   'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Ryan Jones', 'email' => 'ryan.jones@wonderdads.com',    'password' => Hash::make('12345678'),   'created_at' => $now, 'updated_at' => $now]
        ];

        User::insert($array);

    }
}