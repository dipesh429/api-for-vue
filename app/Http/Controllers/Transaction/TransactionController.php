<?php

namespace App\Http\Controllers\Transaction;

use App\Product;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class TransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $transactions=Transaction::latest()->with(['product','buyer'])->get();

        $new_transactions=[];

        foreach($transactions as $transaction){

            if($transaction->product->user_id==14){
                 array_push($new_transactions,$transaction);
            }


        }
 
        return $this->success($new_transactions);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'quantity'=>'required|integer|min:1',
            'location'=>'required'
        ]);

        $data= $request->only(['quantity','location']);


        $data['buyer_id']= $request->buyer;
        $data['product_id']= $request->product;

        $product = Product::find($request->product);

        $available_quantity= $product->quantity;

        if($available_quantity >= $request->quantity){

            $product->quantity-=$request->quantity;
            $product->save();

            if($product->quantity==0){
            $product->status=0;
            $product->save();
            }


            $transaction=Transaction::create($data);

            return $this->success($transaction);

        }

        return $this->error('There is no sufficient quantity',422);
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
