<?php

namespace App\Http\Controllers\Product;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class ProductCategoryController extends ApiController
{
    public function store(Request $request){

    	$request->validate([

    			'category_id'=>'required'
    	]);

    	$product = Product::findOrFail($request->product);

    	$product->categories()->attach($request->category_id);




    }
}
