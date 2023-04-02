<?php /* Tabla de cada noticia que aparece en el carousel */

namespace App;

use App\Traits\HasTag;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasTag;

    protected $table = "news";
    protected $fillable = ["content_without_html_tags", 
        "title", "url",
         "description",
         "sub_tag","image",'thumbnail',
         "status", "date",
         "country","source"
    ];

    public function chart()
    {
        return $this->hasOne('App\Chart','tags','tags'); //por que pone dos veces tags¿?
    }

    public function charts()
    {
        return $this->belongsToMany(Chart::class, 'news_charts', 'news_id', 'chart_id')->where('status',1);
    }

    public function papers()
    {
        return $this->belongsToMany(Papers::class, 'news_data', 'news_id', 'paper_id');
    }

    public function confirmedPapers()
    {
        return $this->belongsToMany(Papers::class, 'news_data', 'news_id', 'paper_id')->where('confirmed',1);
    }

    public function news_source()
    {
        return $this->belongsTo(NewsSource::class,'source');
    }
}

