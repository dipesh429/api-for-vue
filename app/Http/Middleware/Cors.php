<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // return $next($request)


        //           ->header('Access-Control-Allow-Origin','https://dipes.herokuapp.com')
        //           ->header('Access-Control-Allow-Methods','*')
        //           ->header('Access-Control-Allow-Headers','*');


       $response = $next($request);
       $response->header('Access-Control-Allow-Origin','https://dipes.herokuapp.com');
       $response->header('Access-Control-Allow-Methods','*');
       $response->header('Access-Control-Allow-Headers','*');
       return $response;




              
    }
}
