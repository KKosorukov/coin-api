<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\WebmasterResource;
use App\Models;

class WebmasterController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'auth:api',
            \Barryvdh\Cors\HandleCors::class,
        ]);
    }

    /**
     * @param int $id
     * @return WebmasterResource
     */
    public function get(int $id): WebmasterResource
    {
        $webmaster = Models\Backoffice\Webmaster::firstOrFail($id);
        return WebmasterResource::make($webmaster);
    }
}
