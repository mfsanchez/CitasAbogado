<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class WorkDay extends Model
{
    protected $fillable = [
       
        'day',
        'active',
        'morning_start',
        'morning_end',
        'user_id'


    ];
}
