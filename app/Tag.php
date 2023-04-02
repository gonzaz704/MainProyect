<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class Tag extends Model
{
    protected $table = "tags"; 
    protected $fillable = ["name","slug","description","status","is_papers_tags","is_charts_tags","is_news_tags"];


    public function news_tags()
    {
        return $this->hasMany(NewsTag::class);
    }

    public function news()
    {
        return $this->belongsToMany(News::class,'model_has_tags','tag_id','taggable_id')
            ->orderBy('created_at', 'desc');
    }
    public function charts()
    {
        return $this->belongsToMany(Chart::class,'model_has_tags','tag_id','taggable_id');
    }

//     public function charts()
//     {
//         return $this->morphedByMany(Chart::class, 'taggable','model_has_tags');
//     }
}

