<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class moment extends Model
{
    //
    protected  $table='moment';

    protected  $fillable=[
        'posterEmail',
        'posterName',
        'content'
    ];
}
