<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use StatesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
           CountriesSeeder::class,
           StateSeeder::class,
           CitiesSeeder::class,
           CustomerStatusSeeder::class
        ]);

        // \App\Models\User::factory(10)->create();
    }
}
