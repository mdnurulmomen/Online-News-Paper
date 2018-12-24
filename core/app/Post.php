<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function reporter(){
        return $this->belongsTo('App\Reporter');
    }
}
