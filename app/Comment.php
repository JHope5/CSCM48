<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /*
     *  Get the user who made the comment
     */
    public function user() { 
        return $this->belongsTo('App\User');
    }
    
    /*
     *  Get the post the comment belongs to
     */
    public function post() {
        return $this->belongsTo('App\Post');
    }
}
