<?php

namespace Tests\Unit;

use App\Project;
use App\Property;
use App\PropertyType;
use App\Region;
use App\Status;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        
        $this->assertTrue(Project::count() == 10000);
        $this->assertTrue(Property::count() == 100000);
        
        $this->assertTrue(DB::table("properties")
                ->select(DB::raw('project_id, COUNT(*) as total'))
                ->groupBy("project_id")
                ->havingRaw("COUNT(*) = 2001")
                ->get()->count() == 1);


        $statuses = \PropertiesTableSeeder::getStatusesIds();
        $propertyTypes = \PropertiesTableSeeder::getPropertyTypesIds();

        $this->assertTrue(
            Property::where('status_id', $statuses[Status::ACTIVE_NAME])
                ->where('bedroom', 2)
                ->where('property_type_id', $propertyTypes[PropertyType::CONDO_NAME])
                ->where('for_sale', 1)
                ->count() == 3000);


        $this->assertTrue(Property::where('status_id', $statuses[Status::INACTIVE_NAME])
                ->where('property_type_id', $propertyTypes[PropertyType::HOUSE_NAME])
                ->where('for_rent', 1)
                ->whereHas('region', function($q){
                    $q->where('name', \PropertiesTableSeeder::REGION_CHECK);
                })
                ->count() == 0);


        


    }
}
