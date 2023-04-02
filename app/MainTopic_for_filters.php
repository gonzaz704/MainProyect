<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainTopic_for_filters extends Model
{
    //protected $guarded = [];
    protected $table = "main_topic_for_filters"; 
    protected $fillable = ["name"];

    public function Country_for_filters()
    {
        return $this->belongsTo('App\Country_for_filters');
    }

    public function SubTopic1_for_filters()
    {
        return $this->hasMany('App\SubTopic1_for_filters');
    }
}
