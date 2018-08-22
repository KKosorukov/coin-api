<?php

namespace App\Http\Controllers\API\Adv;

use App\Http\Resources\AdvTypeResource;
use App\Models\Backoffice\Adv;
use App\Models\Backoffice\AdvGroup;
use App\Models\Backoffice\AdvType;
use App\Models\Backoffice\Campaign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdvTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'auth:api',
            \Barryvdh\Cors\HandleCors::class,
        ], [
            'only' => [
                'getAllAdvTypes'
            ]
        ]);
    }

    /**
     * Display a listing of the adv types
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAllAdvTypes()
    {
        return AdvTypeResource::collection(AdvType::all());
    }

    /**
     * @TODO !!!
     * @TODO Временный метод. Не забыть выпилить его!!!
     */
    public function clear()
    {
        Adv::query()->truncate();
        AdvGroup::query()->truncate();
        Campaign::query()->truncate();
        return json_encode(['ok']);
    }
}
