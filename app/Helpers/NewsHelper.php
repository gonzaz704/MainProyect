<?php

namespace App\Helpers;

use App\Tag;

class NewsHelper
{
    public function tags()
    {
       return Tag::where('is_news_tags',1)->whereHas('news',function($q){
            $q->whereHas('confirmedPapers');
        })->orderBy('id','DESC')->get();
    }
}

