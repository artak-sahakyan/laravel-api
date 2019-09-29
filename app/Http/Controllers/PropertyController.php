<?php

namespace App\Http\Controllers;

use App\Country;
use App\Project;
use App\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{

    public function index(Request $request)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

        $postData = json_decode($request->getContent(), true);
        print_r($postData['filterFields']);
        die;
        dd($request->query());
        return Property::jsonPaginate();
    }

    public function getFilterOptions()
    {
        echo Property::groupBy('project_id')->havingRaw('count(*) = 2001')->count(); die;
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
        $propertyTypes = \PropertiesTableSeeder::getPropertyTypesIds();
        $statuses = \PropertiesTableSeeder::getStatusesIds();
        $countries = Country::getCountryIds();
        return response()->json(compact('propertyTypes', 'statuses', 'countries'));

    }
}
