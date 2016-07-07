<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userActivity extends Model
{
    //
    protected $table='userActivity';

    protected $fillable=[
        'userEmail',
        'activityId'
    ];
}
