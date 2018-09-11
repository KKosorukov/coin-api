<?php

namespace App\Components;

use App\Http\Resources\SiteResource;
use App\Models\Backoffice\Site;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use RezaAr\Highcharts\Highcharts;
use App\Models\Backoffice\User;

/**
 * Class for generating dashboard
 *
 * Class Dashboard
 * @package App\Components
 */

class Dashboard extends Component {

    private $from; // Filter date from
    private $to; // Filter date to
    private $matomoComponent;

    public function __construct($from = null, $to = null)
    {
        $this->from = $from;
        $this->to = $to;
        $this->matomoComponent = new MatomoAdapter([
            'period' => 'week',
            'date' => '2018-09-03'
        ], User::where('id', 1)->first());

        $this->matomoComponent->setSitesCollection($this->getAllSites());

        parent::__construct();
    }

    /**
     * Get sites per current user. If user doesn't exists, it returns collection for dummy user ( id = 2 )
     *
     * @return SiteResource
     */
    private function getSitesPerUser() {
        return auth()->user() ? auth()->user()->sites : SiteResource::collection(Site::where('user_id', 2)->get());
    }

    /**
     * Get all sites, with Matomo links
     *
     * @return Site[]|\Illuminate\Database\Eloquent\Collection
     */
    private function getAllSites() {
        return SiteResource::collection(Site::all());
    }

    /**
     * Get earnings chart
     */
    public function getEarningsChart() {
        $chart = \Chart::title([
            'text' => 'Earnings',
        ])
        ->chart([
            'type'     => 'line', // pie , columnt ect
            'renderTo' => 'chart-earnings', // render the chart into your div with id
        ])
        ->subtitle([
            'text' => 'Earnings per time',
        ])
        ->colors([
            '#0c2959'
        ])
        ->xaxis([
            'categories' => [
                'Alex Turner'
            ],
            'labels'     => [
                'rotation'  => 15,
                'align'     => 'top',
                'formatter' => 'startJs:function(){return this.value + " (Footbal Player)"}:endJs'
            ],
        ])
        ->yaxis([
            'text' => 'Time',
        ])
        ->legend([
            'layout'        => 'vertikal',
            'align'         => 'right',
            'verticalAlign' => 'middle',
        ])
        ->series(
            [
                [
                    'name'  => 'Voting',
                    'data'  => [43934, 52503, 57177, 69658]
                ],
            ]
        )
        ->display();

        return $chart;
    }

    /**
     * Get traffic chart
     */
    public function getTrafficChart() {
        $chart = \Chart::title([
            'text' => 'Traffic',
        ])
        ->chart([
            'type'     => 'line',
            'renderTo' => 'chart-traffic',
        ])
        ->subtitle([
            'text' => 'Traffic per time',
        ])
        ->colors([
            '#0c2959'
        ])
        ->xaxis([
            'categories' => [
                'Alex Turner'
            ],
            'labels'     => [
                'rotation'  => 15,
                'align'     => 'top',
                'formatter' => 'startJs:function(){return this.value + " (Footbal Player)"}:endJs'
            ],
        ])
        ->yaxis([
            'text' => 'Time',
        ])
        ->legend([
            'layout'        => 'vertikal',
            'align'         => 'right',
            'verticalAlign' => 'middle',
        ])
        ->series(
            [
                [
                    'name'  => 'Voting',
                    'data'  => [43934, 52503, 57177, 69658]
                ],
            ]
        )
        ->display();

        return $chart;
    }

    /**
     * Get sourcetraffic chart
     */
    public function getSourcetrafficChart() {
        $chart = \Chart::title([
            'text' => 'Source Traffic',
        ])
        ->chart([
            'type'     => 'line',
            'renderTo' => 'chart-sourcetraffic',
        ])
        ->subtitle([
            'text' => 'Source Traffic per time',
        ])
        ->colors([
            '#0c2959'
        ])
        ->xaxis([
            'categories' => [
                'Alex Turner'
            ],
            'labels'     => [
                'rotation'  => 15,
                'align'     => 'top',
                'formatter' => 'startJs:function(){return this.value + " (Footbal Player)"}:endJs'
            ],
        ])
        ->yaxis([
            'text' => 'Time',
        ])
        ->legend([
            'layout'        => 'vertikal',
            'align'         => 'right',
            'verticalAlign' => 'middle',
        ])
        ->series(
            [
                [
                    'name'  => 'Voting',
                    'data'  => [43934, 52503, 57177, 69658]
                ],
            ]
        )
        ->display();

        return $chart;
    }

    /**
     * Get bannerview chart
     */
    public function getBannerviewChart() {
        $chart = \Chart::title([
            'text' => 'Traffic',
        ])
        ->chart([
            'type'     => 'line',
            'renderTo' => 'chart-traffic',
        ])
        ->subtitle([
            'text' => 'Traffic per time',
        ])
        ->colors([
            '#0c2959'
        ])
        ->xaxis([
            'categories' => [
                'Alex Turner'
            ],
            'labels'     => [
                'rotation'  => 15,
                'align'     => 'top',
                'formatter' => 'startJs:function(){return this.value + " (Footbal Player)"}:endJs'
            ],
        ])
        ->yaxis([
            'text' => 'Time',
        ])
        ->legend([
            'layout'        => 'vertikal',
            'align'         => 'right',
            'verticalAlign' => 'middle',
        ])
        ->series(
            [
                [
                    'name'  => 'Voting',
                    'data'  => [43934, 52503, 57177, 69658]
                ],
            ]
        )
        ->display();

        return $chart;
    }

    /**
     * Get clicks chart
     */
    public function getClicksChart() {
        $clicks = $this->matomoComponent->getClicksPerSite();

        $chart = \Chart::title([
            'text' => 'Traffic',
        ])
        ->chart([
            'type'     => 'columns',
            'renderTo' => 'chart-clicks',
        ])
        ->subtitle([
            'text' => 'Traffic per time',
        ])
        ->colors([
            '#0c2959'
        ])
        ->xaxis([
            'categories' => [
                'Alex Turner'
            ],
            'labels'     => [
                'rotation'  => 15,
                'align'     => 'top',
                'formatter' => 'startJs:function(){return this.value + " (Footbal Player)"}:endJs'
            ],
        ])
        ->yaxis([
            'text' => 'Time',
        ])
        ->legend([
            'layout'        => 'vertikal',
            'align'         => 'right',
            'verticalAlign' => 'middle',
        ])
        ->series(
            [
                [
                    'name'  => 'Voting',
                    'data'  => [43934, 52503, 57177, 69658]
                ],
            ]
        )
        ->display();

        return $chart;
    }

    /**
     * Get isrobot chart
     */
    public function getIsRobotChart() {
        $chart = \Chart::title([
            'text' => 'Robot',
        ])
        ->chart([
            'type'     => 'line',
            'renderTo' => 'chart-isrobot',
        ])
        ->subtitle([
            'text' => 'Robots per time',
        ])
        ->colors([
            '#0c2959'
        ])
        ->xaxis([
            'categories' => [
                'Alex Turner'
            ],
            'labels'     => [
                'rotation'  => 15,
                'align'     => 'top',
                'formatter' => 'startJs:function(){return this.value + " (Footbal Player)"}:endJs'
            ],
        ])
        ->yaxis([
            'text' => 'Time',
        ])
        ->legend([
            'layout'        => 'vertikal',
            'align'         => 'right',
            'verticalAlign' => 'middle',
        ])
        ->series(
            [
                [
                    'name'  => 'Voting',
                    'data'  => [43934, 52503, 57177, 69658]
                ],
            ]
        )
        ->display();

        return $chart;
    }

    /**
     * Get ctr chart
     */
    public function getCtrChart() {
        $chart = \Chart::title([
            'text' => 'CTR',
        ])
        ->chart([
            'type'     => 'line',
            'renderTo' => 'chart-ctr',
        ])
        ->subtitle([
            'text' => 'CTR per time',
        ])
        ->colors([
            '#0c2959'
        ])
        ->xaxis([
            'categories' => [
                'Alex Turner'
            ],
            'labels'     => [
                'rotation'  => 15,
                'align'     => 'top',
                'formatter' => 'startJs:function(){return this.value + " (Footbal Player)"}:endJs'
            ],
        ])
        ->yaxis([
            'text' => 'Time',
        ])
        ->legend([
            'layout'        => 'vertikal',
            'align'         => 'right',
            'verticalAlign' => 'middle',
        ])
        ->series(
            [
                [
                    'name'  => 'Voting',
                    'data'  => [43934, 52503, 57177, 69658]
                ],
            ]
        )
        ->display();

        return $chart;
    }

    /**
     * Get audition scope chart
     */
    public function getAuditionscopeChart() {
        $chart = \Chart::title([
            'text' => 'Audition Scope',
        ])
        ->chart([
            'type'     => 'line',
            'renderTo' => 'chart-auditionscope',
        ])
        ->subtitle([
            'text' => 'Audition Scope per time',
        ])
        ->colors([
            '#0c2959'
        ])
        ->xaxis([
            'categories' => [
                'Alex Turner'
            ],
            'labels'     => [
                'rotation'  => 15,
                'align'     => 'top',
                'formatter' => 'startJs:function(){return this.value + " (Footbal Player)"}:endJs'
            ],
        ])
        ->yaxis([
            'text' => 'Time',
        ])
        ->legend([
            'layout'        => 'vertikal',
            'align'         => 'right',
            'verticalAlign' => 'middle',
        ])
        ->series(
            [
                [
                    'name'  => 'Voting',
                    'data'  => [43934, 52503, 57177, 69658]
                ],
            ]
        )
        ->display();

        return $chart;
    }

    /**
     * Get click price chart
     */
    public function getClickpriceChart() {
        $chart = \Chart::title([
            'text' => 'Click Price',
        ])
        ->chart([
            'type'     => 'line',
            'renderTo' => 'chart-clickprice',
        ])
        ->subtitle([
            'text' => 'Click price per time',
        ])
        ->colors([
            '#0c2959'
        ])
        ->xaxis([
            'categories' => [
                'Alex Turner'
            ],
            'labels'     => [
                'rotation'  => 15,
                'align'     => 'top',
                'formatter' => 'startJs:function(){return this.value + " (Footbal Player)"}:endJs'
            ],
        ])
        ->yaxis([
            'text' => 'Time',
        ])
        ->legend([
            'layout'        => 'vertikal',
            'align'         => 'right',
            'verticalAlign' => 'middle',
        ])
        ->series(
            [
                [
                    'name'  => 'Voting',
                    'data'  => [43934, 52503, 57177, 69658]
                ],
            ]
        )
        ->display();

        return $chart;
    }

}