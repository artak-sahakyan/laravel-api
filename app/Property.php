<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public $with = ['project', 'status', 'propertyType', 'region'];


    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function propertyType()
    {
        return $this->belongsTo('App\PropertyType');
    }

    public function region()
    {
        return $this->belongsTo('App\Region');
    }

}
