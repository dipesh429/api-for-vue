<?php

namespace App\Http\Controllers;

use App\Traits\Response;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    use Response;

    public function __construct(){

    	// $this->middleware('auth:api');
    }
    
}
