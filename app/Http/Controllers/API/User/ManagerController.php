<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Resources\ManagerResource;
use App\Models;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @todo add auth
 */
class ManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'auth:api',
            \Barryvdh\Cors\HandleCors::class,
        ]);
    }

    /**
     * @param Requests\ListManager $request
     * @return AnonymousResourceCollection
     */
    public function list(Requests\ListManager $request): AnonymousResourceCollection
    {
        $query = $request->status !== null ? ['advs.status' => $request->status] : [];
        $managers = Models\Backoffice\Manager::find($query);

        return ManagerResource::collection($managers);
    }

    /**
     * @param int $id
     * @return ManagerResource
     */
    public function get(int $id): ManagerResource
    {
        $manager = Models\Backoffice\Manager::firstOrFail($id);
        return ManagerResource::make($manager);
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