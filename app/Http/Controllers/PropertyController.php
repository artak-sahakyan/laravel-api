<?php

namespace App\Http\Controllers;

use App\Country;
use App\Project;
use App\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {

        $postData = json_decode($request->getContent(), true);
        print_r($postData['filterFields']);
        die;
        dd($request->query());
        return Property::jsonPaginate();
    }

    public function getFilterOptions()
    {
        $propertyTypes = \PropertiesTableSeeder::getPropertyTypesIds();
        $statuses = \PropertiesTableSeeder::getStatusesIds();
        $countries = Country::getCountryIds();
        return response()->json(compact('propertyTypes', 'statuses', 'countries'));

    }
}
