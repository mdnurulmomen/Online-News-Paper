<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Reporter extends Authenticatable
{
    use Notifiable;
    protected $guarded = 'id';
    protected $fillable = ['firstname', 'lastname', 'email', 'picpath', 'phone', 'address', 'city', 'state', 'country'];
}
//class Reporter extends Model
//{
//
//}
