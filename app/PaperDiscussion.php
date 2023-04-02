<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaperDiscussion extends Model
{
    protected $table = "paper_discussion"; 
    protected $fillable = [
       "paper_id","discussion_id"
    ];

    public function paper()
    {
        return $this->hasOne(Papers::class, 'id', 'paper_id');
    }
}