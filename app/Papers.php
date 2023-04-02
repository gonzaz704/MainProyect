<?php

namespace App;

use App\Traits\HasTag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Papers extends Model
{
    use Notifiable,HasTag;

    protected $table = "papers"; 
    protected $fillable = [
        "titulo",'tutors',"tags",'country','topic', "abstract", "conclusiones_1", "conclusiones_2",
         "conclusiones_3", "conclusiones_4", "conclusiones_5", "conclusiones_6", 
         "conclusiones_7", "conclusiones_8", "conclusiones_9", "link_investigacion", 
         "ruta_grafico", "hashtags", "reviewed","creado_por_id",
         "author","verified","author_name", 'status', 'date'
    ];

    protected $casts = [
        'ruta_grafico' => 'array',
        'tags' => 'array'
    ];

    public function createdBy()
    {
    	return $this->belongsTo('App\User', 'creado_por_id');
    }

    public function news()
    {
        return $this->belongsToMany(News::class, 'news_data', 'paper_id', 'news_id');
    }

    public function routeNotificationForMail()
    {
        return $this->author;
    }

    public function feedbacks()
    {
        return $this->hasMany(PaperFeedback::class,'paper_id','id');
    }

    public function discussions()
    {
        return $this->hasMany(Discussion::class, 'paper_id', 'id');
    }

    public function feedback()
    {
        return $this->hasOne(PaperFeedback::class,'paper_id','id');
    }
}
