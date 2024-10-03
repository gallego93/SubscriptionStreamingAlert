<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Subscriptions;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 1000; $i++) {
            Subscriptions::create([
                'client_id' => $faker->randomElement([1, 1000]),
                'product_id' => $faker->randomElement([1, 30]),
                'user_id' => $faker->randomElement([1, 3]),
                'initial_date' => '2024-09-10',
                'final_date' => '2024-10-10',
            ]);
        }
    }
}
