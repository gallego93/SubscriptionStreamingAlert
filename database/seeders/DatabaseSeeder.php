<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MessageSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(ProductSeeder::class);
        //$this->call(SubscriptionSeeder::class);
    }
}
