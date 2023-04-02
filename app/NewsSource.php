<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsSource extends Model
{
    protected $table = "news_sources";

    protected $fillable = [
        "title","slug","url","country","timezone","image_element","image_attr","image_base_url",
        "status"
    ];
}
