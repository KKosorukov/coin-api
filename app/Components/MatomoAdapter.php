<?php

namespace App\Components;

use App\Http\Resources\SiteResource;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Models\Backoffice\Site;

use GuzzleHttp\Client as GuzzleClient;

/**
 * Class provides Matomo
 *
 * Class MatomoAdapter
 * @package App\Components
 */

class MatomoAdapter extends Component {

    private $version = 'v1';

    private $standartParams = []; // Standart params for matomo URL

    private $guzzle = null;

    private $currentUser = null;

    public function __construct($params = [], $currentUser = null, $version = null)
    {

        $this->currentUser = $currentUser ? $currentUser : auth()->user();

        $this->guzzle = new GuzzleClient();

        if($version) {
            $this->version = $version;
        }

        if($params) {
            $this->setStandartParams($params);
        }

        parent::__construct();
    }

    /**
     * Set sites collection
     *
     * @param $sites
     */
    public function setSitesCollection($sites) {
        foreach ($sites as $site) {
            $this->setSite($site);
        }
    }

    private function setStandartParams($params) {
        /**
         * Set matomo period
         */
        if(isset($params['period']) && !isset($this->standartParams['period'])) {
            $this->standartParams['period'] = $params['period'];
        }

        /**
         * Set begin date
         */
        if(isset($params['date']) && !isset($this->standartParams['date'])) {
            $this->standartParams['date'] = $params['date'];
        }

        if(!isset($this->standartParams['format'])) {
            $this->standartParams['format'] = 'json';
        }
        if(!isset($this->standartParams['filter_limit'])) {
            $this->standartParams['filter_limit'] = '-1';
        }
        if(!isset($this->standartParams['token_auth'])) {
            $this->standartParams['token_auth'] = $this->currentUser->matomo->token_auth;
        }
    }

    /**
     * Set site params
     *
     * @param Site $site
     */
    public function setSite(SiteResource $site) {
        if(!$site) {
            return;
        }

        if(!isset($this->standartParams['sitesList'])) {
            $this->standartParams['sitesList'] = [];
        }

        $this->standartParams['sitesList'][] = $site;
    }

    /**
     * Clean sites list for Matomo
     */
    public function cleanSitesList() {
        $this->standartParams['sitesList'] = [];
    }

    /**
     * Get clicks per sites
     */
    public function getClicksPerSite() {
        $link = $this->_getBaseLink();
        $link = str_replace('{{methodName}}', 'VisitsSummary.get', $link);
        $answer = []; // Answer is ['siteId' => ... , 'numClicks'
        foreach($this->standartParams['sitesList'] as $siteElement) {
            $linkWithSiteId = str_replace('{{siteId}}', $siteElement->id, $link);
            $result = $this->query($linkWithSiteId);
            $decoded = json_decode($result);
            if(isset($decoded->nb_actions)) {
                $answer[(string)$siteElement['id']] = $decoded->nb_actions;
            }
        }

        return $answer;
    }

    /**
     * Get traffic per sites
     */
    public function getTraffic() {

    }

    /**
     * Get source traffic per sites
     */
    public function getSourceTraffic() {

    }

    /**
     * Get robot traffic per sites
     */
    public function getRobotTraffic() {

    }

    /**
     * Get ctr per site
     */
    public function getCtr() {

    }

    /**
     * Get audition per site
     */
    public function getAudition() {

    }

    /**
     * Return result of Matomo API query
     *
     * @param $link
     * @return int|mixed|\Psr\Http\Message\ResponseInterface
     */
    private function query($link) {
        $res = $this->guzzle->request('GET', $link);
        if($res->getStatusCode() == 200) {
            return $res->getBody()->getContents();
        }

        return $res->getStatusCode();
    }

    /**
     * Get base link on the matomo
     */
    private function _getBaseLink() {
        return env('MATOMO_HOST').'/?module=API&method={{methodName}}&idSite={{siteId}}&period='.$this->standartParams['period'].'&date='.$this->standartParams['date'].'&format='.$this->standartParams['format'].'&filter_limit='.$this->standartParams['filter_limit'].'&token_auth='.$this->standartParams['token_auth'].'&serialize=0';
    }
}