<?php

namespace App\Http\Controllers;

use App\User;
use App\Transaction;
use App\Mail\UserCreated;
use Illuminate\Http\Request;
use App\Mail\UserVerification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ApiController;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
       dd('helloo');

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

            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
            'car-no' => 'required',
            'house-no' => 'required',

        ]);

       $data=$request->only(['name','car-no','house-no','email']);
       $data['password'] = bcrypt($request->password);
      
        // dd($data);    
        $user = User::create($data);

       
        return $this->success($user);
    

    }


    public function login(Request $request){


         $request->validate([

            'name' => 'required',
            'password' => 'required'

        ]);


         $user=User::where('name',$request->name)->first();

         if($user){

           if (Hash::check($request->password, $user->password)) {
                    
                   return $this->success($user) ;
                }
           else{

                     return $this->error('Password dont match',404);
           }}  

           return $this->error('Username dont exist',404);
         }

//no. of sold no. by this user

         public function sold(){


            $login_id = request()->user;
            $user = User::find($login_id);

            
            $wastes = $user->wastes->pluck('id');

            // return $wastes;

            $c=0;
            // $transaction=

            foreach($wastes as $waste){
                 $trans = Transaction::where('waste_id',$waste)->get();
                 if(count($trans)){
                     $c= $c+1;
                 }

                } 
            

          return $c;


         }



       //no. of buy by this user

         public function buy(){


            $login_id = request()->user;
            $user = User::find($login_id);

            $users=$user->transactions;

            return count($users);

         }


          //no. of put by this user

         public function put(){


            $login_id = request()->user;
            $user = User::find($login_id);

            $users=$user->wastes;

            return count($users);

         }



 

        







    }






    