<?php

namespace App\Components;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

/**
 * Class generates all random numbers
 *
 * Class RandomGenerator
 * @package App\Components
 */

class RandomGenerator extends Component {
    protected $min = 1; // Default values for min and max
    protected $max = 3;

    public function __construct($min = null, $max = null)
    {
        // @TODO Type checking
        if($max !== null) {
            $this->setMax($max);
        }

        if($min !== null) {
            $this->setMin($min);
        }
        parent::__construct();
    }

    /**
     * Get random number
     *
     * @param $min
     * @param $max
     * @return int
     */
    public function getRandomNumber() {
        return rand($this->min, $this->max);
    }

    /**
     * Set minimum value of generator
     * 
     * @param $min
     * @return $this
     */
    public function setMin($min) {
        $this->min = $min;
        return $this;
    }

    /**
     * Set maximum value of generator
     *
     * @param $max
     * @return $this
     */
    public function setMax($max) {
        $this->max = $max;
        return $this;
    }

    /**
     * Generate random activationToken
     * @return string
     */
    public function generateActivationToken($salt = '') {
        return md5(time().microtime().$salt);
    }

}