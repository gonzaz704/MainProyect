<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsChart extends Model
{
    protected $table = "news_charts";
    protected $fillable = ["news_id","chart_id"];
}
