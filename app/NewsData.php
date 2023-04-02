<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsData extends Model
{
    protected $table = "news_data";
    protected $fillable = ["news_id","paper_id","confirmed","requested_by"];

    public function paper()
    {
        return $this->hasOne(Papers::class, 'id', 'paper_id');
    }

    public function news()
    {
        return $this->hasOne(News::class, 'id', 'news_id');
    }
}
