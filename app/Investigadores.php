<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investigadores extends Model
{
    //
    protected $table = "investigadores";
    protected $fillable = ["nombre_investigadores"];
}