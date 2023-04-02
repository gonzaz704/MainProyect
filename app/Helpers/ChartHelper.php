<?php

namespace App\Helpers;

use App\Chart;


class ChartHelper 
{
    public function chartByTag($tags)
    {
        return Chart::whereIn('tags',$tags)->get();
    }

    public function latestChart($tags)
    {
        return Chart::whereIn('tags', $tags)->latest()->first();
    }
}
