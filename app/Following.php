<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class Following
 * @package App
 */
class Following extends Model
{

    /**
     * @var string
     */
    protected $table = "following";
    /**
     * @var array
     */
    protected $fillable = ["user_id", "following_id"];

    /**
     * @param $id_user
     * @return Model|null|static
     */
    public static function findfollowing($id_user)
    {
        //$query
        return static::where('following_id', $id_user)->where("user_id", Auth::user()->id)->first();
    }

    /**
     * @param $paper_id
     * @return Model|null|static
     */
    public static function findPublicationFollowing($paper_id)
    {
        return static::where('following_id', $paper_id)->where("user_id", Auth::user()->id)->first();
    }

    public function followers()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function followings()
    {
        return $this->belongsTo('App\User', 'following_id');
    }
}

