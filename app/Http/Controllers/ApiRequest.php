<?php

namespace App\Http\Controllers;

use Unirest;

/**
 * ApiRequest
 *
 * @link    https://github.com/vittominacori/coinmarketcap-php
 * @author  Vittorio Minacori (https://github.com/vittominacori)
 * @license https://github.com/vittominacori/coinmarketcap-php/blob/master/LICENSE (MIT License)
 */
abstract class ApiRequest
{
    protected static $apiPath = "https://pro-api.coinmarketcap.com/v1/";
    private static $headers = [
        'Accept : application/json',
        'Content-Type : application/json', 
    ];

    /**
     * ApiRequest constructor.
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
    array_push(self::$headers,'X-CMC_PRO_API_KEY: '.$apiKey); 
    }

    /**
     * @param string $endpoint
     * @param array $parameters
     * @return mixed
     * @throws \Exception
     */
    protected function get($endpoint, $parameters = [])
    {

        $apiCall = self::$apiPath . $endpoint;
         
           
         $curl = curl_init();
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt_array($curl, array(
                CURLOPT_URL => $apiCall,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => self::$headers,
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl); 
           return $response;
            //print_r( self::$headers);
    }
}
