<?php

namespace App\Http\Controllers\Category;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class CategoryController extends ApiController
{
    public function index(){

    	$category=Category::all();
    	return $this->success($category);
    }


    public function show(Category $category){

    	return $this->success($category);
    }

    public function store(Request $request){

    	$request->validate([

    			'name'=>'required',
    			'description'=>'required'

    	]);

    	$data = $request->only(['name','description']);

    	$category = Category::create($data);

    	return $this->success($category);
    }

//find category_name

    public function find($category){

        // dd($category);

        $arr=json_decode($category);

        $id=[];
            
        foreach($arr as $item){

            $category=Category::where('name',$item)->first();
            
            array_push($id, $category->id);

        }    
        
        return $id;

    }
}
