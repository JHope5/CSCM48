<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

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

    /* 
     *  Getting posts created by the user
     */
    public function posts() {
        return $this->hasMany('App\Post');
    }

    /*
     *  Get comments made by the user
     */
    public function comments() {
        return $this->hasMany('App\Comment');
    }

    /*
     *  Get user's additional contact information
     */
    public function additional_contact() {
        return $this->hasOne('App\AdditionalContact');
    }
}
