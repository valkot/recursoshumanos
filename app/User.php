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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
