<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class authApply extends Model
{
    //
    protected $table='authapply';

    protected $fillable=[
        'applyerEmail',
        'applyerName',
        'applyerAuth'
    ];
}
