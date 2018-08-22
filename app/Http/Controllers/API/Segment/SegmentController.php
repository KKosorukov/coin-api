<?php

namespace App\Http\Controllers\API\Segment;

use App\Components\GeonamesConnector;
use App\Http\Controllers\Controller;
use App\Http\Resources\AreaResource;
use App\Http\Resources\CityResource;
use App\Http\Resources\ContinentResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\LanguageResource;
use App\Models\Backoffice\Geonames\Continent;
use App\Models\Backoffice\Language;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

use App\Http\Resources\SegmentResource;
use App\Models\Backoffice\Segment;
use App\Http\Requests\CreateSegment;
use App\Http\Requests\EditSegment;
use Illuminate\Http\Request;

use Locale;
use MichaelDrennen\Geonames\Repositories\GeonameRepository;

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
        $this->middleware([
            'auth:api',
            \Barryvdh\Cors\HandleCors::class,
        ], [
            'only' => [
                'getAllSegments',
                'createSegment',
                'getSegment',
                'updateSegment',
                'deleteSegment',
                'getContinentsList',
                'getCountriesList',
                'getAreasList',
                'getCitiesList'
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

                $newSegment = Segment::create([
                    'name' => $request->name,
                    'comment' => $request->comment,
                    'user_id' => $user->id,
                    'params' => json_encode($request->params),
                    'is_private' => $request->is_private,
                    'type' => $request->type
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

    /**
     * Get continent list
     */
    public function getContinentsList(Request $request) {
        $geonamesConnector = new GeonamesConnector();
        return ContinentResource::collection($geonamesConnector->getContinents());
    }

    /**
     * Get countries list
     */
    public function getCountriesList(Request $request) {
        if(!isset($request->continent)) {
            return [
                'success' => false,
                'data' => 'Not enough params: you need to pass continent param'
            ];
        }

        $geonamesConnector = new GeonamesConnector();
        return CountryResource::collection($geonamesConnector->getCountries($request->continent));
    }

    /**
     * Get areas list in country
     */
    public function getAreasList(Request $request) {
        if(!isset($request->country)) {
            return [
                'success' => false,
                'data' => 'Not enough params: you need to pass country param'
            ];
        }

        $geonamesConnector = new GeonamesConnector();
        return AreaResource::collection($geonamesConnector->getAreas($request->country));
    }

    /**
     * Get cities list
     */
    public function getCitiesList(Request $request) {
        if(!isset($request->country, $request->area)) {
            return [
                'success' => false,
                'data' => 'Not enough params: you need to pass country and area params'
            ];
        }

        $geonamesConnector = new GeonamesConnector();
        return CityResource::collection($geonamesConnector->getCities($request->country, $request->area));
    }

    /**
     * Get languages list
     */
    public function getLanguagesList() {
        if(count(Language::all()) == 0) {
            $languages = ["af", "sq", "ar-SA", "ar-IQ", "ar-EG", "ar-LY", "ar-DZ", "ar-MA", "ar-TN", "ar-OM",
                "ar-YE", "ar-SY", "ar-JO", "ar-LB", "ar-KW", "ar-AE", "ar-BH", "ar-QA", "eu", "bg",
                "be", "ca", "zh-TW", "zh-CN", "zh-HK", "zh-SG", "hr", "cs", "da", "nl", "nl-BE", "en",
                "en-US", "en-EG", "en-AU", "en-GB", "en-CA", "en-NZ", "en-IE", "en-ZA", "en-JM",
                "en-BZ", "en-TT", "et", "fo", "fa", "fi", "fr", "fr-BE", "fr-CA", "fr-CH", "fr-LU",
                "gd", "gd-IE", "de", "de-CH", "de-AT", "de-LU", "de-LI", "el", "he", "hi", "hu",
                "is", "id", "it", "it-CH", "ja", "ko", "lv", "lt", "mk", "mt", "no", "pl",
                "pt-BR", "pt", "rm", "ro", "ro-MO", "ru", "ru-MI", "sz", "sr", "sk", "sl", "sb",
                "es", "es-AR", "es-GT", "es-CR", "es-PA", "es-DO", "es-MX", "es-VE", "es-CO",
                "es-PE", "es-EC", "es-CL", "es-UY", "es-PY", "es-BO", "es-SV", "es-HN", "es-NI",
                "es-PR", "sx", "sv", "sv-FI", "th", "ts", "tn", "tr", "uk", "ur", "ve", "vi", "xh",
                "ji", "zu"];

            foreach ($languages as $language) {
                $newLang = new Language();
                $newLang->displays = $language;
                $newLang->name = $language;
                $newLang->save();
            }
        }

        return LanguageResource::collection(Language::all());
    }
}