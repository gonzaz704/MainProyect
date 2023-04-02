<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaperFeedback extends Model
{
    protected $table = "paper_feedbacks"; 
    protected $fillable = [
       "paper_id","user_id", "description"
    ];

    public function paper()
    {
        return $this->hasOne(Papers::class, 'id', 'paper_id');
    }
}
/*  */