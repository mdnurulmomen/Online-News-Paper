<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\News;

class Comment extends Model
{
    // public function relatedNews(){
    // 	return $this->belongsTo('App/News');
    // }

    public function relatedUser(){
    	return $this->belongsTo('App/User');
    }
    public function parentModel(){
    	return $this->morphTo();
    }
}
