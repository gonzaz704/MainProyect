<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $table = "countries";
    protected $fillable = ["name","code","status"];

    public function topics()
    {
        return $this->hasMany(Topic::class,'country_id');
    }
}
