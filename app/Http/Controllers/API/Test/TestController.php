<?php

namespace App\Http\Controllers\API\Test;

use App\Http\Resources\BannerResource;
use App\Models\Backoffice\Banner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Test Controller for API. Only testing, nothings more.
 *
 * Class TestController
 * @package App\Http\Controllers\API\Test
 */

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BannerResource::collection(Banner::where('id')->paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $banner = Banner::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return new BannerResource($banner);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backoffice\Banner $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        return new BannerResource($banner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $banner->update($request->only(['title', 'description']));

        return new BannerResource($banner);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backoffice\Banner $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();

        return response()->json(null, 204);
    }
}
