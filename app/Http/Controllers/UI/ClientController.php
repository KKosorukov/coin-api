<?php

namespace App\Http\Controllers\UI;


use App\Components\AdvGenerator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mockery\Exception;
use Storage;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tymon\JWTAuth\JWTAuth;

use App\Models\UI\Site as UISite;

use App\Http\Requests\ClientRequest;


class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('exists-site', [
            'only' => [
                'getClientAdv'
            ]
        ]);
    }

    /**
     * Get rendered adv with container
     *
     * @param ClientRequest $request
     */
    public function getClientAdv(ClientRequest $request) {
        if($request->validated()) {

            // Put +1 show into UI-database
            $this->_putShow($request);


            return [
                'success' => true,
                'rendered' => (new AdvGenerator($request->cont_type, $request->cont_form))->get()
            ];
        }
    }


    /**
     * Put show into database
     */
    private function _putShow($request) {
        $ip = $request->server('REMOTE_ADDR');
        $host = UISite::where([
            'host' => $ip
        ])->first();

        if($host) {
            $host->num_shows++;
            $host->save();
        }
    }
}
