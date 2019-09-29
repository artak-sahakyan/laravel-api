<?php

namespace Tests\Unit;

use App\Project;
use App\Property;
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
        
        $this->assertTrue(Project::get()->count() == 10000);
        $this->assertTrue(Property::get()->count() == 100000);
        
        $this->assertTrue(DB::table("properties")
                ->select(DB::raw('project_id, COUNT(*) as total'))
                ->groupBy("project_id")
                ->havingRaw("COUNT(*) = 2001")
                ->get()->count() == 1);


        


    }
}
