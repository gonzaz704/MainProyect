<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dashboard extends Model
{
    //
    protected $table = "dashboard";
    protected $fillable = ["titulo", "conclusiones_1", "conclusiones_2", "conclusiones_3", "link_investigacion", "ruta_grafico"];
}