<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function reporter(){
        return $this->belongsTo('App\Reporter', 'created_reporter_id');
    }

    public function comments(){
    	return $this->morphMany('App\Comment', 'commentable');
    }
}
