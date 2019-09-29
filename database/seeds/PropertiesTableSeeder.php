<?php

use App\Project;
use App\Region;
use App\Status;
use Illuminate\Database\Seeder;
use App\PropertyType;

class PropertiesTableSeeder extends Seeder
{

    const PROJECT_CHECK_COUNT = 2001;
    const CONDO_CHECK_COUNT = 3000;
    const BEDROOM_CHECK_COUNT = 2;
    const REGION_CHECK = 'Region 4';

    protected static $isSeedRunning = false;

    protected static $activeCondo2Count = 0;

    protected static $isFirstProject = true;
    protected static $firstProjectId;
    protected static $projectIds;
    protected static $usedProjectIds = [];

    protected static $propertyTypeIds;
    protected static $statusIds;
    protected static $regionIds;

    protected static $lastStatus;
    protected static $lastBedroom;
    protected static $lastPropertyType;
    protected static $lastForSale;
    protected static $lastRegion;

    /**
     * @return mixed
     */
    public static function getProjectIds()
    {
        if(is_null(static::$projectIds)) {
            static::$projectIds = Project::pluck('id')->toArray();
        }
        return static::$projectIds;
    }

    /**
     * @return mixed
     */
    public static function getRandomProjectId()
    {
        if(!static::$isSeedRunning) {
            return Project::inRandomOrder()->first()->id;
        }


        if(static::$isFirstProject) {

            if(!static::$firstProjectId) {
                $projectIds = static::getProjectIds();
                $projectKey = array_rand($projectIds);
                static::$firstProjectId =  $projectIds[$projectKey];
                unset($projectIds[$projectKey]);
                static::$usedProjectIds[static::$firstProjectId] = 1;
            } else {
                static::$usedProjectIds[static::$firstProjectId]++;
                if(static::$usedProjectIds[static::$firstProjectId] == static::PROJECT_CHECK_COUNT) {
                    static::$isFirstProject = false;
                }
            }
            return static::$firstProjectId;
        }

        $projectIds = static::getProjectIds();
        $projectKey = array_rand($projectIds);
        $projectId = $projectIds[$projectKey];

        if(!isset(static::$usedProjectIds[$projectId])) {
            static::$usedProjectIds[$projectId] = 1;
        } else {
            static::$usedProjectIds[$projectId]++;
        }

        if(static::$usedProjectIds[$projectId] == static::PROJECT_CHECK_COUNT - 1) {
            unset(static::$projectIds[$projectKey]);
        }

        return $projectId;

    }

    /**
     * @return mixed
     */
    public static function getPropertyTypesIds()
    {
        if(is_null(static::$propertyTypeIds)) {
            static::$propertyTypeIds = PropertyType::get()->pluck('id', 'name')->toArray();
        }
        return static::$propertyTypeIds;
    }


    /**
     * @return mixed
     */
    public static function getRandomPropertyTypeId()
    {
        $propertyTypeIds = static::getPropertyTypesIds();
        $key = static::$activeCondo2Count <= static::CONDO_CHECK_COUNT ? PropertyType::CONDO_NAME : array_rand($propertyTypeIds);
        static::$lastPropertyType = $key;
        return $propertyTypeIds[$key];
    }

    /**
     * @return mixed
     */
    public static function getStatusesIds()
    {
        if(is_null(static::$statusIds)) {
            static::$statusIds = Status::get()->pluck('id', 'name')->toArray();
        }
        return static::$statusIds;
    }

    /**
     * @return mixed
     */
    public static function getRandomStatusId()
    {
        $statusIds = static::getStatusesIds();
        if(static::$activeCondo2Count < static::CONDO_CHECK_COUNT) {
            $key = Status::ACTIVE_NAME;
            static::$activeCondo2Count++;
        } else {
            $key = array_rand($statusIds);
        }
        static::$lastStatus = $key;
        return $statusIds[$key];
    }

    /**
     * @return mixed
     */
    public static function getRegionsIds()
    {
        if(is_null(static::$regionIds)) {
            static::$regionIds = Region::get()->pluck('id', 'name')->toArray();
        }
        return static::$regionIds;
    }

    /**
     * @return mixed
     */
    public static function getRandomRegionId()
    {
        $regionsIds = static::getRegionsIds();
        $key = array_rand($regionsIds);
        static::$lastRegion = $key;
        return $regionsIds[$key];
    }

    /**
     * @return int
     */
    public static function getRandomBedroom()
    {
        if(static::$activeCondo2Count <= static::CONDO_CHECK_COUNT) {
            return static::$lastBedroom = static::BEDROOM_CHECK_COUNT;
        }
        return static::$lastBedroom = rand(1, 7);
    }

    /**
     * @return int
     */
    public static function getRandomForSale()
    {
        if(static::$activeCondo2Count <= static::CONDO_CHECK_COUNT) {
            return static::$lastForSale = 1;
        }
        if(static::$lastStatus == Status::ACTIVE_NAME &&
            static::$lastBedroom == static::BEDROOM_CHECK_COUNT &&
            static::$lastPropertyType == PropertyType::CONDO_NAME
        ) {
            return 0;
        }
        return static::$lastForSale = rand(0, 1);
    }

    /**
     * @return int
     */
    public static function getRandomForRent()
    {
        if(static::$lastPropertyType == PropertyType::HOUSE_NAME &&
            static::$lastStatus == Status::INACTIVE_NAME &&
            static::$lastRegion == static::REGION_CHECK
        ) {
            return 0;
        }
        return rand(0, 1);
    }



    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        static::$isSeedRunning = true;
        factory('App\Property', 15000)->create();
    }
}
