<?php

namespace App\Http\Controllers;


use App\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CarController extends ApiController
{
 

 //users/userid
 public function store(Request $request){


       $request->validate([

            'smoke' => 'required|integer',
            'time' => 'required|integer',
            'week' => 'required|integer',

        ]);

       $data=$request->only(['smoke','time','week']);

       $data['user_id']= $request->user;
          
       $car = Car::create($data);

       return $this->success($car);


}

//userid/week/day

public function daywise(){

	$user_id = request()->user;
	$week = request()->week;
	$day = request()->day;

	$car=Car::where('user_id',$user_id)->where('week',$week)->where('time',$day)->get();

	if($car){

		return $this->success($car);

	}
	return $this->error("Data with such info donot exist");

}

//userid/week

public function weekwise(){

	$user_id = request()->user;
	$week = request()->week;
	

	$car=Car::where('user_id',$user_id)->where('week',$week)->get();

	if($car){

		return $this->success($car);

	}
	return $this->error("Data with such info donot exist");

}

//userid/week

public function weekaverage(){

	

	$user_id = request()->user;
	$week = request()->week;

	
	

	$cars=Car::where('user_id',$user_id)->where('week',$week)->get()->pluck('smoke');

	$avg=0;

	if($cars){

		foreach($cars as $car){

		$avg= ($avg+$car);
	}

		return $this->success($avg/count($cars));

	}
	return $this->error("Data with such info donot exist");

}
}

