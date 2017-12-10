<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionProductController extends Controller
{
    public function index(Transaction $trasaction){

     $transaction=Transaction::latest()->get();
	 $products=$transactoin->with(['product.user','buyer'])->get();
 	return $this->success($products);

 }
}
