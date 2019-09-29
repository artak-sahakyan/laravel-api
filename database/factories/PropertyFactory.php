<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use App\Property;
use App\PropertyType;
use App\Region;
use App\Status;
use Faker\Generator as Faker;

$factory->define(Property::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(rand(2, 5)),
        'description' => $faker->sentence(rand(10, 20)),
        'status_id' => PropertiesTableSeeder::getRandomStatusId(),
        'bedroom' => PropertiesTableSeeder::getRandomBedroom(),
        'bathroom' => rand(1, 3),
        'property_type_id' => PropertiesTableSeeder::getRandomPropertyTypeId(),
        'project_id' => PropertiesTableSeeder::getRandomProjectId(),
        'region_id' => PropertiesTableSeeder::getRandomRegionId(),
        'for_rent' => PropertiesTableSeeder::getRandomForRent(),
        'for_sale' => PropertiesTableSeeder::getRandomForSale(),
    ];
});
