<?php

namespace App\Http\Controllers\API\Banner;

use App\Http\Controllers\Controller;
use Mockery\Exception;
use Storage;

use RobBrazier\Piwik\Facades\Piwik;

/**
 * Matomo class for API access
 *
 * Class MatomoController
 * @package App\Http\Controllers\API\Banner
 */

class MatomoController extends Controller
{
    public function __construct()
    {
        /*$this->middleware('auth:api', [
            'only' => [
                'showPreview'
            ]
        ]);*/
    }

    /**
     * Get example
     */
    public function getExampleGraph() {
        
    }
}