<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','first_name','last_name', 'email', 'password','user_status','login_ip','last_login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Get favourite details
    public function getFavorites() {
        return $this->hasMany('App\Models\MyFavorite','user_id','user_id');
    }
    // Get user details
    public function getUserDetails() {
        return $this->hasOne('App\Models\UserDetails','user_id','user_id');
    }
}
