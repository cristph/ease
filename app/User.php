<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected  $table='user';

    protected  $fillable=[
        'email',
        'password',
        'nickname',
        'sex',
        'area',
        'birthday',
        'selfintro',
        'contact',
        'auth',
        'avatar'
    ];
}
