<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Editor extends Authenticatable
{
    use Notifiable;
    protected $guard = 'editor';
    protected $fillable = ['firstname', 'lastname', 'email', 'picpath', 'phone', 'address', 'city', 'state', 'country'];

    public function category()
    {
        return $this->hasMany('App\Category');
    }
}
