<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country_for_filters extends Model
{
    
     protected $table = "country_for_filters"; 
    protected $fillable = ["country"]; 
    
    public function MainTopic_for_filters()
    {
        return $this->hasMany('App\MainTopic_for_filters');
    }
}
