<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Resources\WebmasterResource;
use App\Models;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @todo add auth
 */
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
     * @param Requests\ListWebmaster $request
     * @return AnonymousResourceCollection
     */
    public function list(Requests\ListWebmaster $request): AnonymousResourceCollection
    {
        $query = $request->status !== null ? ['sites.status' => $request->status] : [];
        $webmasters = Models\Backoffice\Webmaster::find($query);

        return WebmasterResource::collection($webmasters);
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

    /**
     * @param int $id
     * @return array
     */
    public function allow(int $id) : array
    {
        return [
            'success' => true
        ];
    }

    /**
     * @param int $id
     * @return array
     */
    public function reject(int $id) : array
    {
        return [
            'success' => true
        ];
    }

    /**
     * @param int $id
     * @return array
     */
    public function block(int $id) : array
    {
        return [
            'success' => true
        ];
    }
}