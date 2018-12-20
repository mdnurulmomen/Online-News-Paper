<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Editor extends Authenticatable
{
    use Notifiable;
    protected $guard = 'editor';

}
//class Editor extends Model
//{
//
//}
