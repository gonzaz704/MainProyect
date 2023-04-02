<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubTopic3_for_filters extends Model
{
    protected $guarded = [];
    public function SubTopic2_for_filters()
    {
        return $this->belongsTo('App\SubTopic2_for_filters');
    }

}
