<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    //
    protected $table = "discussions";
    protected $fillable = ["paper_id","title","description"];

    public function paper()
    {
        return $this->hasOne(Papers::class, 'id', 'paper_id');
    }

    public function paperdiscussion()
    {
        return $this->hasMany(PaperDiscussion::class, 'discussion_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'discussion_id', 'id');
    }
}
