<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\UserProfile;
use Carbon\Carbon;

class ProfileSeeder extends Seeder
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
            ['name' => 'Buyer', 'description' => null, 'created_at' => $now],
            ['name' => 'admin', 'description' => null, 'created_at' => $now]
        ];

        $arrayUser = [
            ['user_id' => 1, 'profile_id' => 1, 'created_at' => $now],
            ['user_id' => 1, 'profile_id' => 2, 'created_at' => $now],
            ['user_id' => 2, 'profile_id' => 1, 'created_at' => $now],
            ['user_id' => 2, 'profile_id' => 2, 'created_at' => $now],
            ['user_id' => 3, 'profile_id' => 1, 'created_at' => $now],
            ['user_id' => 3, 'profile_id' => 2, 'created_at' => $now]
        ];

        Profile::insert($array);
        UserProfile::insert($arrayUser);

    }
}
