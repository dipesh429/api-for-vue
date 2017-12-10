<?php

namespace App\Traits;



trait Response {

	public function success($data,$code=200){

		return response()->json([


			'data' => $data	
		],$code);
	}

	public function error ($data,$code){

		return response()->json([


			'error' => $data,
			'code' => $code	
		],$code);
	}
}


?>