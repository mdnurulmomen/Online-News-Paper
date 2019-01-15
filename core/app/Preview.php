<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Image;

class Preview extends Model
{
    public function image(){
    	return $this->belongTo('App/Image');
    }
}
