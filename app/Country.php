<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
   public static function getCountryIds()
   {
       return self::get()->pluck('id', 'name')->toArray();
   }

    public function regions()
    {
        return $this->hasMany('App\Region');
    }
}
