<?php

namespace App\Http\Controllers;

use App\Car;
use App\User;
use App\Waste;
use App\Transaction;
use App\Mail\Orderdone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ApiController;

// wastes/userid

class WasteController extends ApiController
{

   public function index(Request $request){

      if($request->query()){

        $wastes=Waste::all();
        foreach ( $request->query() as $key => $value) {

           if($value!=''){
          
          if($key=='name'){

             $wastes=Waste::where($key,'like',  '%' . $value . '%')->get();
             // $wastes = $wastes->where($key,'like','%' . $value . '%');

             
          }

          if($key=='quantity' || $key == 'expiry'){
            $wastes = $wastes->where($key,'>=',$value)->values();
          }

          
        }
          }
          

        if(count($wastes)){
            return $this->success($wastes);  
        }

        else{

          return $this->error('Soryyy .... no such data',404);
        }
        
      }

      else{
      $wastes=Waste::where('quantity','>',0)->get();
      return $this->success($wastes);
    }

   }

    public function store(Request $request){


       $request->validate([

            'name' => 'required',
            'expiry' => 'required|integer',
            'quantity' => 'required|integer',

        ]);

       $data=$request->only(['name','quantity','expiry']);

       $data['user_id']= $request->user;
          
       $waste = Waste::create($data);

       return $this->success($waste);

}

  //wastes/order/{waste}/{buyer user}

    public function order(){



      request()->validate([

        'quantity' => 'required|min:1'

      ]);

      $id = request()->waste;
      $buyer_id = request()->user;

      $waste = Waste::find($id);
      
      if(($waste->quantity)<request()->quantity){

          return $this->error('Only ' . ($waste->quantity) . ' is available',415);

      }

       $waste->quantity = ($waste->quantity) - (request()->quantity);



       $user = User::find($waste->user_id);

       $user['quantity'] = request()->quantity;
       $user['waste'] = $waste->name;


       $waste->save();

    

       $data=[];
       $data['quantity']= request()->quantity;
       $data['user_id'] =  $buyer_id ;
       $data['waste_id'] =  $id;

       Transaction::create($data);


       // retry(5,function() use ($user){
       //   Mail::to($user)->send(new Orderdone($user));
       // },100);
       

       
       return $this->success($waste);



    }
}
