<?php

namespace App\Helpers;

use App\Tag;

class TagHelper
{
    public function dropdown()
    {
        return Tag::select('id','name','is_papers_tags','is_news_tags','is_charts_tags','status')->get();
    }

    public function getNewsByTags($model)
    {
        return [];
    }

    public function getMostMatchePaper($model)
    {
        return null;
    }

    public function getPapersByNews($news)
    {
        return null;
    }

    public function getLatestChart($news)
    {
        return null;
    }
}

