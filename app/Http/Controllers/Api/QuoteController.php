<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
class QuoteController extends Controller
{

    public function get_data ($url) {

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function index()
    {
        // chuck norris quote
        $url = env('CHUCK_NORRIS_API_URL');

        $chuck = $this->get_data($url);

        $chuckData = json_decode($chuck, true);

        $chuckQuote = $chuckData["value"];

        $data["quote"] = $chuckQuote;
        $data["quote_source"] = "Chuck Norris"; 


        //cat fact quote
        $url = env('CAT_FACT_API_URL');

        $cat = $this->get_data($url);

        $catData = json_decode($cat, true);

        $catFact = $catData["fact"];

        $data["fact"] = $catFact;
        $data["fact_source"] = "Cat Facts"; 

        // dog fact api currently offline

        return response()->json([
            "status" => "Success",
            "status_code" => 200,
            "message" => "Success get quotes",
            "timestamp" => Carbon::now('UTC')->toIso8601String(),
            "data" => $data,
        ], 200);


    }
}