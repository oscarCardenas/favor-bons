<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\FavorBond;
use Carbon\Carbon;

class FavorBondsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $data = [
            'subcategory_id' => 1,
            'user_id' => 1,
            'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quod soluta minima tempora libero itaque nisi doloribus eius omnis quibusdam placeat, nam neque repellat cupiditate expedita, dolor in aliquam commodi accusantium.',
            'qualified_description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quod soluta minima tempora libero itaque nisi doloribus eius omnis.',
            'price' => '1',
            'price_description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit.',
            'execution_of_favor_id' => 1,
            'unlimited' => 1,
            'stock' => null,
            'image' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $array = [];
        for ($i=0; $i < 200; $i++) {
            $subcategory_id = rand(1, 68);
            $array[$i] = $data;
            $array[$i]['title'] = 'Favorbonds ' . $i;
            $array[$i]['subcategory_id'] = $subcategory_id;
        }

        FavorBond::insert($array);

    }
}

