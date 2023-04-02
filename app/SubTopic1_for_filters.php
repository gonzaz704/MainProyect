<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubTopic1_for_filters extends Model
{

    protected $guarded = [];
    /* protected $table = "sub_topic1_for_filters"; 
    protected $fillable = ["SubTopic1"]; */

    public function MainTopic_for_filters()
    {
        return $this->belongsTo('App\MainTopic_for_filters');
    }

    public function SubTopic2_for_filters()
    {
        return $this->hasMany('App\SubTopic2_for_filters');
    }
}
