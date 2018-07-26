<?php

namespace App\Components;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Storage;

/**
 * Class provides ApiCode
 *
 * Class ApiCode
 * @package App\Components
 */

class ApiCode extends Component {

    const DUMMY_PATH = 'banners/dummy';

    private $version = 'v1';

    public function __construct($version = null)
    {
        if($version) {
            $this->version = $version;
        }

        parent::__construct();
    }

    /**
     * Get API code
     *
     * @return mixed
     */
    public function get() {
        if(Storage::disk('local')->exists('api/' . $this->version . '/api.js')) {
            return Storage::get('api/' . $this->version . '/api.js');
        } else {
            echo 'Incorrect code link';
        }
    }
}