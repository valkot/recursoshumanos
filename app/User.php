<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;
    public $guarded = [];
    
    public static function boot()
    {
        parent::boot();

        static::creating(function($user)
        {
            $password = substr($user->rut, 0, 4);
            $user->password = $password;
        });
          
        static::created(function($user)
        {
            $password = substr($user->rut, 0, 4);
            $user->password = $password;
        });
    }

    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt(intval($value));
    }

    public function perfil()
    {
        return $this->belongsTo('App\Perfil', 'perfil_id');
    }

    public function servicio()
    {
		return $this->belongsTo('App\Servicio', 'servicio_id');
    }
}