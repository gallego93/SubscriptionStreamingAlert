<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Products;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 30; $i++) {
            Products::create([
                'name' => $faker->name,
                'price' => $faker->randomFloat(2, 1, 100),
                'period' => $faker->numberBetween(8, 30),
                'user_id' => $faker->randomElement([1, 2]),
            ]);
        }
    }
}
