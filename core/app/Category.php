<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function childNews(){
        return $this->hasMany('App\News');
    }

    public function getNameParentAttribute(){
        if ($this->parent == 0)
            return 'none';
        else{
            $parent = Category::findOrFail($this->parent);
            return $parent->name;
        }
    }
}
