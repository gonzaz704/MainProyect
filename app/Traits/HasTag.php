<?php

namespace App\Traits;

use App\Tag;

trait HasTag
{
    public function tags()
    {
        return $this->morphToMany(Tag::class,'taggable','model_has_tags');
    }
}