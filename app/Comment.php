<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = "comments";
    protected $fillable = ["discussion_id","user_id","message"];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
