<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable; 
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable {
    use \Illuminate\Auth\Authenticatable; 

    public function drums() { 
        return $this->hasMany('App\Drum'); 
    } 

    public function bookmarks() { 
        return $this->hasMany('App\Bookmark'); 
    } 
} 
