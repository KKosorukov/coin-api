<?php

namespace App\Http\Controllers\API\Banner;

use App\Components\ApiCode;
use App\Components\ApiCounter;
use App\Components\RandomGenerator;
use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;
use App\Models\Backoffice\Container;
use App\Models\Backoffice\Banner;
use Illuminate\Http\Request;
use Mockery\Exception;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

use App\Http\Requests\EditBanner;
use App\Http\Requests\CreateBanner;
use App\Http\Requests\UploadBanner;

use App\Components\Banner as BannerComponent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tymon\JWTAuth\JWTAuth;


class BannerController extends Controller
{
    private $randomGenerator; // Generator of random
    private $bannerComponent; // Component of banner

    public function __construct()
    {
        $this->middleware('auth:api', [
            'only' => [
                'showPreview',
                'getCode',
                'getAllBanners',
                'createBanner',
                'editBanner',
                'deleteBanner',
                'getBanner',
                'uploadBanner'
            ]
        ]);

        $this->randomGenerator = new RandomGenerator();
        $this->bannerComponent = new BannerComponent();
    }

    /**
     * Get banner by type
     * @param $type
     */
    public function getByType($type) {
        return $this->_get($type, 'get');
    }

    /**
     * Get banner, general inner method
     *
     * @param $type
     * @param $methodName
     * @return mixed
     */
    private function _get($type, $methodName) {
        // @TODO Here will be splitting and filtering by user. After inserting usermodel.
        if(!isset($this->bannerComponent->bannerTypes[$type])) {
            throw new Exception('Not found', 404);
        }

        return view(
            $this->defaultLayoutPath, [
                'mainCssPath' => '/css/layouts/main.css',
                'content' => (new $this->bannerComponent->bannerTypes[$type]['type']($this->bannerComponent->bannerTypes[$type]['params']))->$methodName()
            ]
        );
    }

    /**
     * Get a random banner
     *
     * @return mixed
     */
    public function getRandom() {
        // @TODO This is temporary method
        return (new $this->bannerComponent->bannerTypes[0]['type']())->get();
    }

    /**
     * Get API code counter
     *
     * @param Request $request
     * @return mixed
     * @throws \App\Exceptions\ApiKeyNotDefinedException
     */
    public function getCode(Request $request) {
        return (new ApiCounter())->get(auth()->user()->api_key);
    }


    /**
     * Get API
     *
     * @param string $version
     * @return mixed
     */
    public function getApi(Request $request) {
        // If API key is correct...
        if(User::where('api_key', $request->api_key)->get()) {
            return (new ApiCode())->get();
        } else {
            throw new AccessDeniedHttpException('Cannot find correct API user');
        }
    }

    /**
     * Show preview of any ad if you a moderator
     */
    public function showPreview($type) {
        $authed = $this->getAuthenticatedUser();

        if (auth()->user()->hasAccess('banners.get-moderated')) {
            return $this->_get($type, 'dummy');
        } else {
            throw new Exception(403);
        }
    }

    /**
     * Get all banners
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAllBanners() {
        return BannerResource::collection(Banner::where('user_id', auth()->user()->id)->get());
    }

    /**
     * Upload banner into a store
     *
     * @param UploadBanner $request
     * @return array
     */
    public function uploadBanner(UploadBanner $request) {
        if($request->validated()) {
            $uploadAnswer = (new BannerComponent())->upload($request->banner);
            return [
                'success' => $uploadAnswer['status'],
                'data' => $uploadAnswer['fileName']
            ];
        }
    }

    /**
     * Create banner for container
     * @param CreateBanner $request
     */
    public function createBanner(CreateBanner $request) {
        // @TODO Make constraint about banners
        if($request->validated()) {
            $user = auth()->user();

            if(!$user->hasAccess('banners.create')) {
                $newBanner = Banner::create($request->all() + [
                    'user_id' => auth()->user()->id,
                    'adv_id' => $request->adv_id,
                    'title' => $request->title,
                    'description' => $request->description,
                    'path' => $request->file,
                    'container_id' => $request->container_id
                ]);

                return BannerResource::make($newBanner);
            } else {
                return $this->returnForbidden();
            }
        }
    }

    /**
     * Edit banner for container
     * @param EditBanner $request
     */
    public function updateBanner(EditBanner $request) {
        if($request->validated()) {
            $user = auth()->user();

            $updatedBanner = Banner::find($request->banner);
            if(!$updatedBanner) {
                throw new NotFoundHttpException('Banner not found');
            }

            if($user->hasAccess('banners.edit') || ($user->hasAccess('banners.edit-own') && $user->id == $updatedBanner->user_id)) {
                $updatedBanner->update($request->all());
                return [
                    'success' => (bool)$updatedBanner,
                    'data' => BannerResource::make($updatedBanner)
                ];
            } else {
                return $this->returnForbidden();
            }
        }
    }


    /**
     * Delete banner for container
     *
     * @param Request $request
     * @return array
     */
    public function deleteBanner(Request $request) {
        $user = auth()->user();

        $bannerModel = Banner::find($request->banner);
        if(!$bannerModel) {
            throw new NotFoundHttpException('Banner not found');
        }

        if($user->hasAccess('banners.delete') || ($user->hasAccess('banners.delete-own') && $user->id == $bannerModel->user_id)) {
            $answer = BannerResource::make($bannerModel);
            $bannerModel->delete();
            return [
                'success' => (bool)$answer,
                'data' => $answer
            ];
        } else {
           return $this->returnForbidden();
        }
    }

    /**
     * Get banner for container
     *
     * @param Request $request
     * @return BannerResource
     */
    public function getBanner(Request $request) {
        return BannerResource::make(Banner::find($request->banner));
    }
}
