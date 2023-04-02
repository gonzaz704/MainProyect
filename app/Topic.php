<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topics';
    protected $fillable = ['name', 'country_id', 'parent_id','slug','status'];

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }

    public function children()
    {
        return $this->hasMany(Topic::class,'parent_id');
    }
}