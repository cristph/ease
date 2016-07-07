<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdviceApply extends Model
{
    //
    protected $table='adviceapply';

    protected $fillable=[
        'userEmail',
        'userName',
        'adviserEmail',
        'adviserName',
        'adviserType'
    ];
}
