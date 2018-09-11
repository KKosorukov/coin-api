<?php

namespace App\Http\Controllers\Face;

use App\Components\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class IndexController
 *
 * This class an implementation of all face pages in the api project
 *
 * @package App\Http\Controllers\Face
 * @author Kosorukov Kirill
 *
 */

class IndexController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Get main index page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex() {
        return view('face/index', []);
    }

    /**
     * Get test static page with code
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTestStaticPage() {
        return view('face/test', [
            'generalHost' => env('COIN_API_URL'),
            'matomoHost' => env('MATOMO_HOST')
        ]);
    }


    /**
     * Get test static page with Highcharts
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getHighChartsTestPage() {
        $dashboard = new Dashboard();

        return view('face/test-highcharts', [
            'chartEarnings' => $dashboard->getEarningsChart(),
            'chartTraffic' => $dashboard->getTrafficChart(),
            'chartSourcetraffic' => $dashboard->getSourcetrafficChart(),
            'chartBannerviews' => $dashboard->getBannerviewChart(),
            'chartClicks' => $dashboard->getClicksChart(),
            'chartIsrobot' => $dashboard->getIsRobotChart(),
            'chartCtr' => $dashboard->getCtrChart(),
            'chartAuditionscope' => $dashboard->getAuditionscopeChart(),
            'chartClickprice' => $dashboard->getClickpriceChart()
        ]);
    }

    /**
     * Activate account: face page with redirect to API
     *
     * @param Request $request
     */
    public function activateAccount(Request $request) {
        return redirect('/api/v1/user/' . $request->user . '/activate/' . $request->token);
    }
}
