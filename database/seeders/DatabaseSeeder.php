<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhilippineBarangaysTableSeeder;
use PhilippineCitiesTableSeeder;
use PhilippineProvincesTableSeeder;
use PhilippineRegionsTableSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            PhilippineCitiesTableSeeder::class,
            PhilippineRegionsTableSeeder::class,
            PhilippineProvincesTableSeeder::class,
            PhilippineBarangaysTableSeeder::class,
        ]);
    }
}
