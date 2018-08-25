<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drum extends Model
{
    public function drum() { 
        return $this->belongsTo('App\User'); 
    } 

    public function bookmarks() { 
        return $this->hasMany('App\Bookmark'); 
    } 
}
