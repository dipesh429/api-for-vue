<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'smoke', 
        'time',
        'week',
        'user_id'
       
    ];
}


