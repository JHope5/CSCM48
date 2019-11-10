<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdditionalContact extends Model
{
    /*
     *  Get the user associated with the contact information
     */
    public function user() {
        return $this->belongsTo('App\User');
    }
}
