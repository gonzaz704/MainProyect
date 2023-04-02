<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategoria extends Model
{
    protected $table = "sub_categoria";
    protected $fillable = ["categoria_id", "nombre_subcategoria"];
}
