<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;


class Intereses extends Model
{
    protected $table = "intereses";
    protected $fillable = ["nombre","descripcion", "activo"];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
