<?php

namespace App\Http\Controllers;

use App\cryptocurrency;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api;

class CryptocurrencyController extends Controller
{
    public function index()
    { 
   	
    	$api_key=config('app.api_key');
    	$get_api = new Api($api_key); 

		try {
		    $json=  $get_api->cryptocurrency()->listingsLatest(['limit' => 3, 'convert' => 'EUR']) ;
		  	$arrjson=json_decode($json)->data;
		  	//Cache::('list',$arrjson,10); 
		  	$arr_cache = array();
		  	foreach ($arrjson as $value) {
			    array_push($arr_cache,[
			    	'name'=>$value->name,
			    	'shortcode' => $value->symbol,
			    	'current price' => $value->quote->USD->price,
			    	'date of update' => $value->last_updated,
			    ] );
				} 
		  	Cache::set('list',$arr_cache );  
		  	echo "succes :-)";
		} catch (\Exception $e) {
		    echo "Error {$e->getCode()}: {$e->getMessage()}";
		} 
	}
 

	public function store_cache()
    {  
    	$data=Cache::get('list' );

         return $data;
	}
}
