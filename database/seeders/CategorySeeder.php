<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Carbon\Carbon;

class CategorySeeder extends Seeder
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
            ['name' => 'Career Advice', 'description' => null, 'type' => null, 'created_at' => $now],
            ['name' => 'Business Advice', 'description' => null, 'type' => null, 'created_at' => $now],
            ['name' => 'Due Diligence Calls', 'description' => null, 'type' => null, 'created_at' => $now],
            ['name' => 'Private Lessons', 'description' => null, 'type' => null, 'created_at' => $now],
            ['name' => 'Private Tours & Demonstrations', 'description' => null, 'type' => null, 'created_at' => $now],
            ['name' => 'Physical Goods', 'description' => null, 'type' => null, 'created_at' => $now],
            ['name' => 'Software', 'description' => null, 'type' => null, 'created_at' => $now],
            ['name' => 'Services', 'description' => null, 'type' => null, 'created_at' => $now],
            ['name' => 'Real Estate', 'description' => null, 'type' => null, 'created_at' => $now],
            ['name' => 'Unique Favors', 'description' => null, 'type' => null, 'created_at' => $now]
        ];

        Category::insert($array);

    }
}


