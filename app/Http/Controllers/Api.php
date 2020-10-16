<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Cryptocurrency; 

/**
 * Api
 *
 * @link    https://github.com/vittominacori/coinmarketcap-php
 * @author  Vittorio Minacori (https://github.com/vittominacori)
 * @license https://github.com/vittominacori/coinmarketcap-php/blob/master/LICENSE (MIT License)
 */
class Api
{
    private static $apiKey;
    private static $cryptocurrency = null; 

    /**
     * Api constructor.
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        self::$apiKey = $apiKey;
    }

    /**
     * @return Cryptocurrency
     */
    public static function cryptocurrency(): Cryptocurrency
    {
        self::$cryptocurrency = self::$cryptocurrency ?: new Cryptocurrency(self::$apiKey);
        return self::$cryptocurrency;
    }
 
}
