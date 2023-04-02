<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubTopic2_for_filters extends Model
{
    protected $guarded = [];
    public function SubTopic1_for_filters()
{
    return $this->belongsTo('App\SubTopic1_for_filters');
}

public function SubTopic3_for_filters()
{
    return $this->hasMany('App\SubTopic3_for_filters');
}
}