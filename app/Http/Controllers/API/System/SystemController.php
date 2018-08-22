<?php 

namespace App\Http\Controllers\API\System;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\JsonResponse;
use App\Components\ApiCounter;

/**
* All System Actions are in this controller
*/
class SystemController extends Controller {
    public function __construct()
    {
        $this->middleware([
            'auth:api',
            \Barryvdh\Cors\HandleCors::class,
        ]);
    }
    
    /**
     * Get code (for webmaster)
     * 
     * @param $userId 
     * @return mixed
     **/
    public function getCodeByUserId($user) {
        if(User::where('id', $user)->count() > 0) {
            $counter = new ApiCounter();
            return [
                'success' => true
                'code' => $counter->get(auth()->user()->api_key)
            ];
        } else {
             return [
                'success' => false
            ];
        }
    }
}