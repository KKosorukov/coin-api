<?php

namespace App\Http\Controllers\API\Segment;

use App\Http\Controllers\Controller;
use Mockery\Exception;

use App\Http\Resources\SegmentResource;
use App\Models\Backoffice\Segment;
use App\Http\Requests\CreateSegment;
use App\Http\Requests\EditSegment;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Segment class for API access
 *
 * Class SegmentController
 * @package App\Http\Controllers\API\Segment
 */

class SegmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', [
            'only' => [
                'getAllSegments',
                'createSegment',
                'getSegment',
                'updateSegment',
                'deleteSegment'
            ]
        ]);
    }

    /**
     * Display a listing of the advs
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAllSegments()
    {
        return SegmentResource::collection(Segment::all());
    }

    /**
     * Store a newly created resource in storage
     *
     * @param CreateSegment $request
     * @return SegmentResource
     */
    public function createSegment(CreateSegment $request) {
        if($request->validated()) {

            $user = auth()->user();

            if($user->hasAccess('segments.create')) {

                $newSegment = Segment::create($request->all() + [
                        'user_id' => $user->id
                    ]);

                return SegmentResource::make($newSegment);
            } else {
                return $this->returnForbidden();
            }
        }
    }

    /**
     * Display the specified resource
     *
     * @param $segment
     * @return SegmentResource
     */
    public function getSegment($segment)
    {
        $segment = Segment::where([
            'id' => $segment,
            'user_id' => auth()->user()->id
        ])->first();

        return $segment ? new SegmentResource($segment) : [];
    }

    /**
     * Update the specified resource in storage
     *
     * @param EditSegment $request
     * @return array
     */
    public function updateSegment(EditSegment $request)
    {
        if($request->validated()) {
            $user = auth()->user();

            $updatedSegment = Segment::where([
                'id' => $request->segment,
                'user_id' => $user->id
            ])->first();

            if(!$updatedSegment) {
                throw new NotFoundHttpException('Segment not found');
            }

            if($user->hasAccess('segments.edit') || ($user->hasAccess('segments.edit-own') && $user->id == $updatedSegment->user_id)) {
                $updatedSegment->update($request->all());
                return [
                    'success' => (bool)$updatedSegment,
                    'data' => SegmentResource::make($updatedSegment)
                ];
            } else {
                return $this->returnForbidden();
            }
        }
    }

    /**
     * Remove the specified adv from storage.
     *
     * @param $id
     * @return array
     */
    public function deleteSegment($id)
    {
        $user = auth()->user();

        $segmentModel = Segment::find($id);
        if(!$segmentModel) {
            throw new NotFoundHttpException('Segment not found');
        }

        if($user->hasAccess('segments.delete') || ($user->hasAccess('segments.delete-own') && $user->id == $segmentModel->user_id)) {
            $answer = SegmentResource::make($segmentModel);
            $segmentModel->delete();
            return [
                'success' => (bool)$answer,
                'data' => $answer
            ];
        } else {
            return $this->returnForbidden();
        }
    }
}