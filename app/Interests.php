<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interests extends Model
{
    //
    protected $table = "papers"; //donde carga los valores $table y fillable?
    protected $fillable = ["titulo", "conclusiones_1", "conclusiones_2", "conclusiones_3", "link_investigacion", "ruta_grafico", "hashtags"];

    public function createdBy()
    {
    	return $this->belongsTo('App\User', 'creado_por_id');
    }

}