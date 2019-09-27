<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = ['Thailand', 'Cambodia'];
        foreach ($countries as $country) {
            DB::table('countries')->insert([
                'name' => $country,
            ]);
        }
    }
}
