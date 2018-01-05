<?php

namespace App\Http\Controllers;

use App\Car;
use App\User;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

//reward/loginid

class RewardController extends ApiController
{


	public function index(){

		$login_id = request()->user;

		//sold

		 $user = User::find($login_id);


            $wastes = $user->wastes->pluck('id');

            $c=0;

            foreach($wastes as $waste){
                 $trans = Transaction::where('waste_id',$waste)->get();
                 if(count($trans)){
                     $c= $c+1;
                 }

                } 
            

          $sold= $c;


         //buy
         


            $users=$user->transactions;

            $buy= count($users);

          //put
          

           $users=$user->wastes;

            $put = count($users);


          

	$cars=Car::where('user_id',$login_id)->where('week',1)->get()->pluck('smoke');

	$avg=0;

	if($cars){

		foreach($cars as $car){

		$avg= ($avg+$car);
	}

		$smoke_avg= ($avg/count($cars));

	}
	
	$final_data = [

			'sold' => $sold,
			'buy' => $buy,
			'put' => $put,
			'smoke_avg' => $smoke_avg,
	];

	return $this->success($final_data);


}

}
	
    

