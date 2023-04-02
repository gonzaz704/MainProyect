<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class Vote
 * @package App
 */
class Vote extends Model
{
    /**
     * @var string
     */
    protected $table = "votes"; //donde carga los valores $table y fillable?
    /**
     * @var array
     */
    protected $fillable = ["user_id", "publication_id"];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function publications()
    {
        return $this->hasMany('\App\Papers', 'creado_por_id');
    }

    /**
     * @param $paper_id
     * @return Model|null|static
     */
    public static function findVoters($paper_id)
    {
        return static::where('publication_id', $paper_id)->where("user_id", Auth::user()->id)->first();
    }
}
