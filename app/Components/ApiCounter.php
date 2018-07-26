<?php

namespace App\Components;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Storage;
use App\Exceptions\ApiKeyNotDefinedException;
/**
 * Class provides ApiCounter
 *
 * Class ApiCounter
 * @package App\Components
 */

class ApiCounter extends Component {

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
    public function get($key) {
        if(!auth()->user()->api_key) {
            throw new ApiKeyNotDefinedException('Not exists API key for user' );
        }


        if(Storage::disk('local')->exists('code/' . $this->version . '/code.js')) {
            $codeFile = (string)Storage::get('code/' . $this->version . '/code.js');
            $codeFile = preg_replace('/\{\{\s*\$apiKey\s*\}\}/', auth()->user()->api_key, $codeFile);
            return $codeFile;
        } else {
            echo 'Incorrect code link';
        }
    }

    /**
     * Generate API key
     */
    public function generateApiKey() {
        return md5(rand(0, 1000000).microtime());
    }
}