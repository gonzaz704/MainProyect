<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaperReview extends Model
{
    protected $table = "paper_reviews"; 
    protected $fillable = [
       "paper_id","user_id","status"
    ];

    public function paper()
    {
        return $this->hasOne(Papers::class, 'id', 'paper_id');
    }
}
