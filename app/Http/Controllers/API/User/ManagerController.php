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
     * @param Requests\AddTokens $request
     * @return array
     */
    public function addTokens(Requests\AddTokens $request) : array
    {
        $bill = Models\Backoffice\Bill::firstOrNew(['user_id' => $request->user_id]);

        if (is_array($bill->num_tokens)) {
            $bill->num_tokens = $bill->num_tokens['ADT'] + $request->tokens_count;
        } else {
            $bill->num_tokens = $request->tokens_count;
        }

        $success = $bill->save();

        return [
            'success' => $success
        ];
    }
}