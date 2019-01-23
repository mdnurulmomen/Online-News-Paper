<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Editor extends Authenticatable
{
    use Notifiable;
    protected $guarded = ['id'];
//    public function category()
//    {
//        return $this->hasMany('App\Category');
//    }
    public function setEditorCategoriesAttribute($categories = array())
    {
        $this->attributes['categories_id'] = json_encode($categories);
    }

    public function getEditorCategoriesAttribute(){
        $caregoryIds = json_decode($this->categories_id);
        return Category::whereIn('id', $caregoryIds)->get(['id','name']);
    }
}
