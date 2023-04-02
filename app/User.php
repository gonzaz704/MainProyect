<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Intereses;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','foto','nivel_academico_id','pais_id','country',"type","deleted_at"
    ];

    public $append = [
        'rank'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function papers()
    {
        return $this->hasMany('\App\Papers', 'creado_por_id');
    }


    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    public function following()
    {
        return $this->hasMany('\App\Following', 'user_id');  
    }

    public function seguir() //preguntarle a un usuario a que otros usuarios sigue
    {
        return $this->belongsToMany(User::class, 'seguidoress', 'user_id', 'siguiendo_id');//yo los sigo a ellos
    }

    public function seguidores()
    {
        return $this->belongsToMany(User::class, 'seguidoress', 'siguiendo_id', 'user_id');//relacion entre un usuario y otro usuario, es la misma tabla pero al reves. Yo soy el que es seguido, dime quienes son los que sigo

        //CON ESTO LE PUEDO PREGUNTAR A UN USUARIO TANTO QUIENES LO SIGUEN COMO A QUIEN SIGUE
    }

    public function intereses()
    {
        return $this->belongsToMany(Intereses::class);
    }

    public function roles()
    {
        return $this->morphedByMany(
            config('permission.models.role'),
            'model',
            config('permission.table_names.model_has_roles'),
            'model_id',
            'role_id'
        );
    }

    public function getRankAttribute()
    {
        $role = $this->roles->first();
        if($role->name === 'Admin'){
            return 'Admin';
        }
        $rank = UserRank::where('user_id',$this->id)->first();
        if($rank){
            foreach (config('points.tag.' . $role->name) as $key =>  $tag) {
                if ($rank->point >= $key) {
                    return $tag;
                }
            }
        }
        
        return config('points.tag.' . $role->name . '.default');
        
    }
    
    public function userrank()
    {
        return $this->hasOne(UserRank::class,'user_id');
    }

    public function avatar()
    {
        $user = Auth::user();
        if($user){
            if($user->foto){
                return "/images/" . $user->foto;
            }
            return \Avatar::create($user->name)->toBase64();
        }
        return null;
    }
}
