<?php
/**
 * Created by IntelliJ IDEA.
 * User: kirillk
 * Date: 7/4/18
 * Time: 2:23 PM
 */

namespace App\Components;

use Swap\Laravel\Facades\Swap;
use App\Components\Component;

/**
 * This is component for converting different currencies
 *
 * Class CurrenciesConverter
 * @package App\Components
 */

class CurrenciesConverter extends Component {
    const USD_TO_ADT = 10000; // Curse of USD / ADT

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Convert ADT to BTC, USD, EUR
     *
     * @param $value
     */
    public function convertAdt($value, $testMode = true) {
        if(!$testMode) {
            return [
                'ADT' => $value,
                'USD' => 1,
                'USD/ADT' => self::USD_TO_ADT / $value,
                'EUR/USD' => round((float)Swap::latest('EUR/USD')->getValue(), 2),
                'BTC/USD' => round((float)Swap::latest('BTC/USD')->getValue(), 2),
            ];
        } else {
            return [
                'ADT' => $value,
                'USD' => 1,
                'USD/ADT' => self::USD_TO_ADT / $value,
                'EUR/USD' => 1.25,
                'BTC/USD' => 6756.73,
            ];
        }
    }
}