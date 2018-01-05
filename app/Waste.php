<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Waste extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'quantity',
        'expiry',
        'user_id'
       
    ];

    public function user(){

        $this->BelongTo(User::class);
    }
}

