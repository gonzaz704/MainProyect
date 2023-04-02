<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsTag extends Model
{
    protected $table = "news_tags";
    protected $fillable = ["news_id","tag_id"];
    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
