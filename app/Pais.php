<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    
    protected $table = "pais"; //donde carga los valores $table y fillable?
    protected $fillable = ["nacionalidad", "nombre", "activo"];

}
