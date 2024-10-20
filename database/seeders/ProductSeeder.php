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
        Products::create([
            'name' => 'Netflix',
            'price' => '10000',
            'period' => '30',
            'user_id' => '1',
        ]);
        Products::create([
            'name' => 'Disney+',
            'price' => '10000',
            'period' => '30',
            'user_id' => '1',
        ]);
        Products::create([
            'name' => 'Amazon Prime Video',
            'price' => '10000',
            'period' => '30',
            'user_id' => '1',
        ]);
        Products::create([
            'name' => 'Hulu',
            'price' => '10000',
            'period' => '30',
            'user_id' => '1',
        ]);
        Products::create([
            'name' => 'Sling Tv',
            'price' => '10000',
            'period' => '30',
            'user_id' => '1',
        ]);
        Products::create([
            'name' => 'HBO Max',
            'price' => '10000',
            'period' => '30',
            'user_id' => '1',
        ]);
        Products::create([
            'name' => 'Crackle',
            'price' => '10000',
            'period' => '30',
            'user_id' => '1',
        ]);
        Products::create([
            'name' => 'Peacock',
            'price' => '10000',
            'period' => '30',
            'user_id' => '1',
        ]);
        Products::create([
            'name' => 'YoutubeTV',
            'price' => '10000',
            'period' => '30',
            'user_id' => '1',
        ]);
        Products::create([
            'name' => 'Tubi',
            'price' => '10000',
            'period' => '30',
            'user_id' => '1',
        ]);
        Products::create([
            'name' => 'Shudder',
            'price' => '10000',
            'period' => '30',
            'user_id' => '1',
        ]);
        Products::create([
            'name' => 'Crunchyroll',
            'price' => '10000',
            'period' => '30',
            'user_id' => '1',
        ]);
    }
}
