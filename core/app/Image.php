<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;

class Image extends Model
{  
    public function comments(){
    	return $this->morphMany('App\Comment', 'commentable');
    }
}
