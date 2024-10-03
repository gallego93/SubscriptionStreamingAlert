<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
            'remember_token' => Str::random(10),
        ])->assignRole('admin');

        User::create([
            'name' => 'AsesorUno',
            'email' => 'asesoruno@user.com',
            'email_verified_at' => now(),
            'password' => Hash::make('asesoruno'),
            'remember_token' => Str::random(10),
        ])->assignRole('user');

        User::create([
            'name' => 'AsesorDos',
            'email' => 'asesordos@user.com',
            'email_verified_at' => now(),
            'password' => Hash::make('asesordos'),
            'remember_token' => Str::random(10),
        ])->assignRole('user');
    }
}
