<?php

namespace App;

use App\User;
use App\Product;
use App\Category;
use App\Transaction;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    

    protected $fillable=['name','quantity','description','price','image','user_id'];

    public function categories(){

		return $this->BelongsToMany(Category::class);
	}   

	public function user(){

		return $this->BelongsTo(User::class);
	}

	public function transactions(){

		return $this->hasMany(Transaction::class);
	}
}
