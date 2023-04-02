<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NAcademico extends Model
{
    protected $table = "nivel_academico"; //donde carga los valores $table y fillable?
    protected $fillable = ["nombre", "descripcion", "activo"];
}
