<?php

namespace App;

use App\Product;
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
        'email', 
        'password',
        'verified',
        'verification_token',
        'admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
        
    ];


   
    public static function verification_token(){

        return str_random(40); //must be higher .......... so that it can't be brueteforced
    }

    public function products(){

        return $this->HasMany(Product::class);
    }

    public function transactions(){

        return $this->hasMany(Transaction::class);
    }



    // public function getCreatedAtAttribute($value){

     // return $value->diffForHumans();
     // return $value->year;
     // dd($value);
    // }


}
