<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advice extends Model
{
    //
    protected $table='advice';

    protected $fillable=[
        'userEmail',
        'userName',
        'adviserEmail',
        'adviserName',
        'adviserType',
        'content'
    ];
}
