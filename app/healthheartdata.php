<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class healthheartdata extends Model
{
    //
    protected $table='healthheartdata';

    protected $fillable=[
        'userEmail',
        'date',
        'rate'
    ];
}
