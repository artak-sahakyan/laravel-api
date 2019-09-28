<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard(); // Disable mass assignment

        /*$this->call(StatusesTableSeeder::class);
        $this->call(PropertyTypesTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);*/
        $this->call(PropertiesTableSeeder::class);

        Model::reguard(); // Enable mass assignment
    }
}
