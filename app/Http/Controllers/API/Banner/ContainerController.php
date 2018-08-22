<?php

namespace App\Http\Controllers\API\Banner;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContainerTypeResource;
use App\Http\Resources\ContainerResource;
use App\Models\Backoffice\ContainerType;
use App\Models\Backoffice\Container;
use Mockery\Exception;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

use App\Components\Banner as BannerComponent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;

use App\Http\Requests\CreateUserContainer;
use App\Http\Requests\EditUserContainer;

class ContainerController extends Controller
{
    /**
     * ContainerController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->middleware([
            'auth:api',
            \Barryvdh\Cors\HandleCors::class,
        ],  [
            'only' => [
                'getContainers',
                'getContainerTypes',
                'createContainerProUser',
                'editContainerProUser',
                'deleteContainerProUser'
            ]
        ]);
    }

    /**
     * Get all container types
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getContainerTypes(Request $request) {
        return ContainerTypeResource::collection(ContainerType::all());
    }

    /**
     * Get all containers
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getContainers(Request $request) {
        return ContainerResource::collection(Container::where('user_id', auth()->user()->id)->get());
    }

    /**
     * Create container with banners from interface
     *
     * @param CreateUserContainer $request
     * @return array
     */
    public function createContainerProUser(CreateUserContainer $request) {
        if($request->validated()) {
            $newCont = Container::create($request->all() + ['user_id' => auth()->user()->id]);

            return [
                'success' => (bool) $newCont,
                'data' => ContainerResource::make($newCont)
            ];
        }
    }


    /**
     *  Edit container pro user in interface
     *
     * @param EditUserContainer $request
     * @return array
     */
    public function editContainerProUser(EditUserContainer $request, $container) {
        if($request->validated()) {
            $user = auth()->user();

            $updatedCont = Container::find($container);
            if(!$updatedCont) {
                throw new NotFoundHttpException('Container not found');
            }

            if($user->hasAccess('containers.edit') || ($user->hasAccess('containers.edit-own') && $user->id == $updatedCont->user_id)) {
                $updatedCont->update($request->all());
                return [
                    'success' => (bool)$updatedCont,
                    'data' => Container::find($request->container)
                ];
            } else {
                return $this->returnForbidden();
            }
        }
    }

    /**
     * Delete container pro user
     *
     * @param Request $request
     * @return array
     */
    public function deleteContainerProUser(Request $request, $container) {
        $user = auth()->user();

        $contModel = Container::find($container);
        if(!$contModel) {
            throw new NotFoundHttpException('Container not found');
        }

        if($user->hasAccess('containers.delete') || ($user->hasAccess('containers.delete-own') && $user->id == $contModel->user_id)) {
            $deletedCont = $contModel->delete();
            return [
                'success' => (bool) $deletedCont,
                'data' => $contModel
            ];
        } else {
            return $this->returnForbidden();
        }
    }

    /**
     * Get container pro user
     *
     * @param Request $request
     * @return ContainerResource
     */
    public function getContainerProUser(Request $request, $container) {
        $user = auth()->user();

        $contModel = Container::find($container);
        if(!$contModel) {
            throw new NotFoundHttpException('Container not found');
        }

        if($user->hasAccess('containers.delete') || ($user->hasAccess('containers.delete-own') && $user->id == $contModel->user_id)) {
            return ContainerResource::make($contModel);
        } else {
            return $this->returnForbidden();
        }
    }
}

?>