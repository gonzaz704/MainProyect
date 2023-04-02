<?php

namespace App;

use App\Traits\HasTag;
use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
    use HasTag;

    protected $table = "charts";
    
    protected $fillable = [
        'title',
        'user_id',
        'topic',
        'author',
        'author_email',
        'type',
        'template',
        'status',
        'description',
        'source_name',
        'source_web'
    ];

    public function news()
    {
        return $this->belongsToMany(News::class, 'news_charts', 'chart_id', 'news_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
}
