<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\News;
use App\User;

class Comment extends Model
{
    // public function relatedNews(){
    // 	return $this->belongsTo('App/News');
    // }
	protected $guarded = ['id']; 
    
    public function relatedUser(){
    	return $this->belongsTo('App\User','user_id','id');
    }

    public function parentModel(){
    	return $this->morphTo();
    }
}
