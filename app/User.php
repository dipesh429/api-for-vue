<?php

namespace App;

use App\Waste;
use App\Product;
use App\Transaction;
use Laravel\Passport\HasApiTokens;
use App\Transformers\UserTransformer;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use HasApiTokens;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'password',
        'car-no',
        'house-no',
        'email'
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
        
    ];

    public function wastes(){

        return $this->hasMany(Waste::class);
    }

    public function transactions(){

        return $this->hasMany(Transaction::class);
    }


   

}