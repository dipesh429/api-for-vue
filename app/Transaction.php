<?php

namespace App;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable=['quantity','location','product_id','buyer_id'];

    public function transactions(){

		return $this->hasMany(Product::class);
	}

	public function product(){

		return $this->BelongsTo(Product::class);
	}

	public function buyer(){

		return $this->BelongsTo(User::class);
	}

	// public function getCreatedAtAttribute($value){

	// // 	// return $value->diffForHumans();
	// 	return Carbon::createFromFormat('Y-m-d',$value);
	// }
}
