<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    /*
     *  Get posts with a topic
     */
    public function posts() {
        return $this->belongsToMany('App\Post');
    }
}
