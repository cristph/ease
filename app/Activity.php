<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //
    protected $table='activity';

    protected $fillable=[
        'theme',
        'posterName',
        'posterEmail',
        'startTime',
        'endTime',
        'content'
    ];
}
