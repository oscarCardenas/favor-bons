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
            'price_description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit.',
            'unlimited' => 1,
            'stock' => null,
            'image' => null,
            'created_at' => $now
        ];

        $array = [];
        for ($i=0; $i < 150; $i++) {
            $subcategory_id = rand(1, 68);
            $array[$i] = $data;
            $array[$i]['title'] = 'Favorbonds ' . $i;
            $array[$i]['subcategory_id'] = $subcategory_id;
            $array[$i]['price'] = rand(1, 4);
            $array[$i]['execution_of_favor_id'] = rand(1, 4);
            // sleep(5);
            $array[$i]['updated_at'] = Carbon::now();
            // FavorBond::insert($array[$i]);
        }

        FavorBond::insert($array);

    }
}

