<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //  \App\Models\User::factory(6)->create();

        $faker = Faker::create();

        \App\Models\User::factory()->create([
            'avatar' => $faker->image,
            'name' => $faker->firstName,
            'email' => $faker->email,
            'role' => 'admin',
            'password' => 123456789,
            
        ]);

        \App\Models\User::factory()->create([
            'avatar' => $faker->image,
            'name' => $faker->firstName,
            'email' => $faker->email,
            'role' => 'Customer',
            'password' => 123456789,
            
        ]);
    }
}
