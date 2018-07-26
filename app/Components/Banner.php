<?php

namespace App\Components;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Illuminate\Support\Facades\Storage;

/**
 * Class provides all banner env
 *
 * Class Banner
 * @package App\Components
 */

class Banner extends Component {

    const DUMMY_PATH = 'banners/dummy';

    public $bannerTypes = [ // Types of banners
        [
            'type' =>  \App\Models\Backoffice\AdvTypes\AdvBanner::class,
            'params' => ['width' => 300, 'height' => 100, 'dontCreatePath' => true]
        ],
        [
            'type' => \App\Models\Backoffice\AdvTypes\AdvCarousel::class,
            'params' => []
        ],
        [
            'type' =>  \App\Models\Backoffice\AdvTypes\AdvBanner::class,
            'params' => ['num-in-row' => 3]
        ],
        [
            'type' =>  \App\Models\Backoffice\AdvTypes\AdvBanner::class,
            'params' => ['width' => 200, 'height' => 200], // Get banner 200 x 200
        ],
        [
            'type' =>  \App\Models\Backoffice\AdvTypes\AdvBanner::class,
            'params' => ['width' => 240, 'height' => 400], // Get banner 240 x 400
        ],
        [
            'type' =>  \App\Models\Backoffice\AdvTypes\AdvBanner::class,
            'params' => ['width' => 250, 'height' => 250], // Get banner 250 x 250
        ],
        [
            'type' =>  \App\Models\Backoffice\AdvTypes\AdvBanner::class,
            'params' => ['width' => 250, 'height' => 360], // Get banner 250 x 360
        ],
        [
            'type' =>  \App\Models\Backoffice\AdvTypes\AdvBanner::class,
            'params' => ['width' => 300, 'height' => 250], // Get banner 300 x 250
        ],
        [
            'type' =>  \App\Models\Backoffice\AdvTypes\AdvBanner::class,
            'params' => ['width' => 336, 'height' => 280], // Get banner 336 x 280
        ],
        [
            'type' =>  \App\Models\Backoffice\AdvTypes\AdvBanner::class,
            'params' => ['width' => 120, 'height' => 600], // Get banner 120 x 600
        ],
        [
            'type' =>  \App\Models\Backoffice\AdvTypes\AdvBanner::class,
            'params' => ['width' => 160, 'height' => 600], // Get banner 160 x 600
        ],
        [
            'type' =>  \App\Models\Backoffice\AdvTypes\AdvBanner::class,
            'params' => ['width' => 300, 'height' => 1050], // Get banner 300 x 1050
        ],
        [
            'type' =>  \App\Models\Backoffice\AdvTypes\AdvBanner::class,
            'params' => ['width' => 468, 'height' => 60], // Get banner 468 x 60
        ],
        [
            'type' =>  \App\Models\Backoffice\AdvTypes\AdvBanner::class,
            'params' => ['width' => 728, 'height' => 90], // Get banner 728 x 90
        ],

        [
            'type' =>  \App\Models\Backoffice\AdvTypes\AdvBanner::class,
            'params' => ['width' => 930, 'height' => 180], // Get banner 930 x 180
        ],

        [
            'type' =>  \App\Models\Backoffice\AdvTypes\AdvBanner::class,
            'params' => ['width' => 970, 'height' => 90], // Get banner 970 x 90
        ],

        [
            'type' =>  \App\Models\Backoffice\AdvTypes\AdvBanner::class,
            'params' => ['width' => 970, 'height' => 250], // Get banner 970 x 250
        ],

        [
            'type' =>  \App\Models\Backoffice\AdvTypes\AdvBanner::class,
            'params' => ['width' => 980, 'height' => 120], // Get banner 980 x 120
        ],
        [
            'type' =>  \App\Models\Backoffice\AdvTypes\AdvBanner::class,
            'params' => ['width' => 980, 'height' => 120, 'format' => \App\Models\Backoffice\Formats\Text::class], // Get banner 980 x 120 and with text format
        ],
        [
            'type' =>  \App\Models\Backoffice\AdvTypes\AdvText::class,
            'params' => ['text' => 'This is text banner and only text'], // Get banner 980 x 120 and with text format
        ],
        [
            'type' =>  \App\Models\Backoffice\AdvTypes\AdvAdaptive::class, // Adaptive
            'params' => ['width' => 100, 'height' => 100]
        ]
    ];

    /**
     * Upload banner into fileSystem
     *
     * @param $banner
     * @return array
     */
    public function upload($banner) {
        $base64Str = substr($banner, strpos($banner, ",") + 1);
        $image = base64_decode($base64Str);
        $explode = explode(',', $banner);
        $format = str_replace(
            [
                'data:image/',
                ';',
                'base64',
            ],
            [
                '', '', '',
            ],
            $explode[0]
        );

        $extensions = [
            'jpeg' => 'jpg',
            'png' => 'png',
            'svg' => 'svg',
            'gif' => 'gif'
        ];

        $safeName = md5(time().microtime().auth()->user()->id).'.'.$extensions[$format];
        return [
            'status' => Storage::disk('public')->put('/banners/'.$safeName, $image),
            'fileName' => $safeName
        ];
    }
}