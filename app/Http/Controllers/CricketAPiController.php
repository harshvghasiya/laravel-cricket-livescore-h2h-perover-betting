<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CricketAPiController extends Controller
{
    public function listByLeague(Request $request)
    {
    	// dd(liveScore());	
    	// code...

    	// curl --location --request GET 'https://cricket.sportmonks.com/api/v2.0/continents';
    	// $data="https://cricket.sportmonks.com/api/v2.0/teams?api_token=tZTCfVrgI9SlThvS0Tj0iLXnJsjM8DWeAYEUUeZ5JrVSCps4XM6FGnbM25kb&include=";
    	// dd($data);

		$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://cricket.sportmonks.com/api/v2.0/teams?api_token=tZTCfVrgI9SlThvS0Tj0iLXnJsjM8DWeAYEUUeZ5JrVSCps4XM6FGnbM25kb&include=",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	
]);

$response1 = curl_exec($curl);
$err = curl_error($curl);
 // $response3=matchDetail('641393');
curl_close($curl);


		$curl = curl_init();

		curl_setopt_array($curl, [
			CURLOPT_URL => "https://cricket.sportmonks.com/api/v2.0/livescores?api_token=VUQmIiCn6oNCzEVqzgAaHXd3cIhSPBeoWJA3buaeDZrYWQAXCaqAp3riCS7R&include=",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			
		]);

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			 dd(json_decode($response1),json_decode($response));
		}

    }
}
