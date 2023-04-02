<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class Following
 * @package App
 */
class Follower extends Model
{

    /**
     * @var string
     */
    protected $table = "followers";
    /**
     * @var array
     */
    protected $fillable = ["user_id", "follower_id	"];


}

