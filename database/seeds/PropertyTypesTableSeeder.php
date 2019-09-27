<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $propertyTypes = ['Condo', 'House', 'Land'];
        foreach ($propertyTypes as $propertyType) {
            DB::table('property_types')->insert([
                'name' => $propertyType,
            ]);
        }
    }
}
