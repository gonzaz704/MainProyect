<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = "chatter_categories";
    protected $fillable = ["parent_id","order","name","color","slug"];
}
