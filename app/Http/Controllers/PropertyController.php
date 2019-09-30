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
        $postData = json_decode($request->getContent(), true);
        $filterFields = array_filter($postData['filterFields']);
        $sortMatches = [
            'status' => 'status_id',
            'forSale' => 'for_sale',
            'forRent' => 'for_rent',
            'propertyType' => 'property_type_id',
        ];

        $sort = isset($sortMatches[$postData['sortField']]) ? $sortMatches[$postData['sortField']] : $postData['sortField'];
        $query = Property::orderBy($sort, $postData['sortType']);

        if (isset($filterFields['bedroom'])) {
            $query->where('bedroom', $filterFields['bedroom']);
        }

        if (isset($filterFields['bathroom'])) {
            $query->where('bathroom', $filterFields['bathroom']);
        }

        if (isset($filterFields['propertyType'])) {
            $query->where('property_type_id', $filterFields['propertyType']);
        }

        if (isset($filterFields['status'])) {
            $query->where('status_id', $filterFields['status']);
        }

        if (isset($filterFields['forSale'])) {
            $query->where('for_sale', $filterFields['forSale']);
        }

        if (isset($filterFields['forRent'])) {
            $query->where('for_rent', $filterFields['forRent']);
        }

        if (isset($filterFields['title'])) {
            $query->where('title', 'like', "%{$filterFields['title']}%");
        }

        if (isset($filterFields['description'])) {
            $query->where('description', 'like', "%{$filterFields['description']}%");
        }

        if (isset($filterFields['projectName'])) {
            $query->whereHas('project', function($q) use ($filterFields){
                $q->where('name', 'like', "%{$filterFields['projectName']}%");
            });
        }

        if (isset($filterFields['country'])) {
            $query->whereHas('region', function($q) use ($filterFields){
                $q->where('country_id', $filterFields['country']);
            });
        }

        return $query->jsonPaginate();
    }

    public function getFilterOptions()
    {
        $fields = [
            'title' => [
                'label' => 'Title',
            ],
            'description' => [
                'label' => 'Description',
            ],
            'bedroom' => [
                'label' => 'Bedroom',
                'options' => array_combine(range(1, 7), range(1, 7))
            ],
            'bathroom' => [
                'label' => 'Bedroom',
                'options' => array_combine(range(1, 7), range(1, 7))
            ],
            'propertyType' => [
                'label' => 'Property Type',
                'options' => \PropertiesTableSeeder::getPropertyTypesIds()
            ],
            'status' => [
                'label' => 'Status',
                'options' => \PropertiesTableSeeder::getStatusesIds()
            ],
            'forSale' => [
                'label' => 'For Sale',
                'options' => ['NO' => 0, 'YES' => 1]
            ],
            'forRent' => [
                'label' => 'For Rent',
                'options' => ['NO' => 0, 'YES' => 1]
            ],
            'projectName' => [
                'label' => 'Project Name',
            ],
            'country' => [
                'label' => 'Country',
                'options' => Country::getCountryIds()
            ],
        ];
        return response()->json($fields);

    }
}
