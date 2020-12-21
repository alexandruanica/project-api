<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TableController extends Controller
{
    public function show() {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://app.socialinsider.io/api');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"jsonrpc\": \"2.0\", \"id\": 0, \"method\": \"partner_api.get_brands\", \"params\": {\"projectname\": \"Automotive\"}}");

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: Bearer interviu';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        $result = json_decode($result);
        $brands = $result->result;
        return $brands;
//        $brandData = [];
//        for($i = 0; $i < count($brands); $i++)
//            array_push($brandData,
//            TableController::getBrandData($brands[$i]->brandname));
//
//
//        return $brandData;
    }

    public function getBrandDataAux($name) {
        return TableController::getBrandData($name);
    }

    function getBrandData($name) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://app.socialinsider.io/api');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"jsonrpc\": \"2.0\", \"id\": 0, \"method\": \"partner_api.get_brand_data\", \"params\": {\"projectname\": \"Automotive\", \"brandname\": \"$name\"}}");

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: Bearer interviu';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return json_encode(json_decode($result)->result);
    }
}
