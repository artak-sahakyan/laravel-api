<?php

use Illuminate\Database\Seeder;
use App\PropertyType;

class PropertiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory('App\Property', 15000)->create();
    }
}
