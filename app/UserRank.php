<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRank extends Model
{
    protected $table = "user_ranks";
    protected $fillable = ["user_id","point"];
}
