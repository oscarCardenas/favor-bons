<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\ExecutionOfFavor;
use Carbon\Carbon;

class ExecutionOfFavorSeeder extends Seeder
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
            ['name' => 'phone', 'created_at' => $now],
            ['name' => 'virtual call', 'created_at' => $now],
            ['name' => 'FaceTime', 'created_at' => $now],
            ['name' => 'in-person', 'created_at' => $now]
        ];

        ExecutionOfFavor::insert($array);

    }
}