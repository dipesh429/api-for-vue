<?php

namespace App\Http\Controllers;

use App\User;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class UserProductController extends ApiController

{

 public function seller(){

    $user=request()->user;

    $transactions=Transaction::latest()->with(['product.user','buyer'])->get();

        $new_transactions=[];

        foreach($transactions as $transaction){

            if($transaction->product->user_id==$user){
                 array_push($new_transactions,$transaction);
            }


        }
 
        return $this->success($new_transactions);
 	

 }

 public function buyer(){

    $user=request()->user;

    $transactions=Transaction::latest()->with(['product.user','buyer'])->get();

        $new_transactions=[];

        foreach($transactions as $transaction){

            if($transaction->buyer->id==$user){
                 array_push($new_transactions,$transaction);
            }


        }
 
        return $this->success($new_transactions);
    

 }


  public function store(Request $request,$user)
    {



        $request->validate([

                'name' => 'required',
                'quantity'=> 'required|integer',
                'description'=> 'required',
                'price'=> 'required|integer',
                'image' => 'required' 

        ]);



        $data = $request->only(['name','quantity','description','price']);

        $file_name=$request->image->getClientOriginalName();

        $location = $request->image->storeAs('img',$file_name);

        $data['image']=asset("storage/{$location}");
        

        $data['user_id']=$user;

        $product = Product::create($data);



        return $this->success($product);
    }  
}
