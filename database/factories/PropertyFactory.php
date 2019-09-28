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
        'bedroom' => rand(1, 7),
        'bathroom' => rand(1, 3),
        'property_type_id' => function () {
            return PropertyType::inRandomOrder()->first()->id;
        },
        'status_id' => function () {
            return Status::inRandomOrder()->first()->id;
        },
        'for_sale' => rand(0, 1),
        'for_rent' => rand(0, 1),
        'project_id' => function () {
            return Project::inRandomOrder()->first()->id;
        },
        'region_id' => function () {
            return Region::inRandomOrder()->first()->id;
        },
    ];
});
