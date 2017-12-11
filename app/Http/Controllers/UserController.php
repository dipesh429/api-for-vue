<?php

namespace App\Http\Controllers;

use App\User;
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
        
        $users = User::all();
        return $this->success($users);

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
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6'
       ]);

       $data=$request->only(['name','email']);
       $data['password'] = bcrypt($request->password);
       $data['verification_token'] = User::verification_token();

       return DB::transaction(function() use ($data){

        $user = User::create($data);
        Mail::to($user)->send(new UserCreated($user));
        return $this->success($user);

       });

       
       

       


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $this->success($user);

        // return$user->created_at
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
    
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
    
    }

    // public function login(Request $request){


    //     $request->validate([

    //         'email' => 'required|email',
    //         'password' => 'required',
            
    //    ]);

    //     $user = User::where('email',$request->email)->first();

    //     if(!$user){

    //         return $this->error('user with such email dont exist',422);

    //     }

    //     if($user && Hash::check($request->password,$user->password)){

    //         return $this->success($user);
    //     }

    //     return $this->error('Password didnot match',422);



    // }


    public function check($email){



        $user=User::where('email',$email)->first();

        if($user){

             if($user->verified==1){

                return $this->success($user);
             }

             else{

                return $this->error("You are not a verified user. First verify your email. Email Confirmation was sent to your email when you signup earlier",415);
             }
        }

        else{

            return $this->error('User with this email donot exist',415);
        }
    }

    public function verify(Request $request){

        $user=User::where('verification_token',$request->code)->first();

        if($user){

            $user->verification_token='';
            $user->verified=1;
            $user->save();

            
            return $this->success('you are successfully verified..go back to website and signin');
        }

        return $this->error('you cant be verified...wrong credentials');


        
    }



}
