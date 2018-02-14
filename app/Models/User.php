<?php

namespace App\Models;

//use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    //use Authenticatable, Authorizable, CanResetPassword,Notifiable;

    protected $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'full_name_case', 'email', 'password', 'position_id', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

}
