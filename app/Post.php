<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /*
     *  Get the user who made the post
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

    /*
     *  Get the topic(s) of the post
     */
    public function topics() {
        return $this->belongsToMany('App\Topic');
    }

    /*
     *  Get the post's comments
     */
    public function comments() {
        $this->hasMany('App\Comment');
    }
}