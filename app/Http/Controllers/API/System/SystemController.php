<?php 

namespace App\Http\Controllers\API\System;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Resources\TimezoneResource;
use App\Models\Backoffice\Timezone;
use Illuminate\Http\JsonResponse;
use App\Components\ApiCounter;

/**
* All System Actions are in this controller
*/
class SystemController extends Controller {
    public function __construct()
    {
        $this->middleware([
            'auth:api'
        ], [
            'only' => 'getCodeByUserId'
        ]);

        $this->middleware([
            \Barryvdh\Cors\HandleCors::class
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
                'success' => true,
                'code' => $counter->get(auth()->user()->api_key)
            ];
        } else {
             return [
                'success' => false
            ];
        }
    }

    /**
     * Get timezones list. Public method.
     */
    public function getTimezonesList() {
        return TimezoneResource::collection(Timezone::all()->reverse());
    }
}