<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Clients;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Clients::create([
            'name' => 'Señor Thompson',
            'address' => 'avenida siempre viva 123',
            'phone' => '764 - 84377',
            'email' => 'thompson@fake.com',
            'user_id' => '2',
        ]);
        Clients::create([
            'name' => 'Hermes Conrad',
            'address' => '7297 Tressa Street',
            'phone' => '(585) 749-3727',
            'email' => 'hermes@fake.com',
            'user_id' => '2',
        ]);
        Clients::create([
            'name' => 'Guillermo Pfeffer',
            'address' => '424 Rolfson Stream Apt. 252',
            'phone' => '+1-269-778-5639',
            'email' => 'littel.austen@hotmail.com',
            'user_id' => '3',
        ]);
    }
}
