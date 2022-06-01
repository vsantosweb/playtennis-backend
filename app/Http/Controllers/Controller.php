<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected function outputJSON($data = [], $message = null, $success = true,  $responseCode = 200) {

        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' =>  $data,
        ], $responseCode );
    }
}
