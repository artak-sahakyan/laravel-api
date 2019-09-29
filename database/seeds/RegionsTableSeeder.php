<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{

    const THAILAND_ID = 1;
    const CAMBODIA_ID = 2;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countriesRegions = [
            static::THAILAND_ID => [
                'Region 1', 'Region 2'
            ],
            static::CAMBODIA_ID => [
                'Region 7', 'Region 4'
            ],
        ];
        
        foreach ($countriesRegions as $countryId => $countryRegions) {
            foreach ($countryRegions as $region) {
                DB::table('regions')->insert([
                    'name' => $region,
                    'country_id' => $countryId
                ]);    
            }
            
        }
    }
}
