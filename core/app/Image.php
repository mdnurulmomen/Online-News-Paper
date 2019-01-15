<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Preview;

class Image extends Model
{
    public function Preview(){
    	$this->hasOne('App/Preview');
    }
}
