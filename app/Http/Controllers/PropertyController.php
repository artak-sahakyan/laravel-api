<?php

namespace App\Http\Controllers;

use App\Project;
use App\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        echo '<pre>';


        print_r(\PropertiesTableSeeder::getRandomPropertyTypeId());

        die;

        \PropertiesTableSeeder::rr();
        die;

        print_r(Project::getProjectIds());

        die;

        dd($request->query());
        return Property::jsonPaginate();
    }
}
