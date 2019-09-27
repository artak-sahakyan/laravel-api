<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(StatusesTableSeeder::class);
         $this->call(PropertyTypesTableSeeder::class);
         $this->call(CountriesTableSeeder::class);
         $this->call(RegionsTableSeeder::class);
         $this->call(ProjectsTableSeeder::class);
         $this->call(PropertiesTableSeeder::class);
    }
}
