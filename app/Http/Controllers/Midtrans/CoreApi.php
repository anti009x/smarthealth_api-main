<?php

namespace App\Http\Controllers\Midtrans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoreApi extends Controller
{
    public static function charge($params)
    {
        $payloads = array(
            'payment_type' => 'credit_card'
        );
        
        if (array_key_exists('item_details', $params)) {
            $gross_amount = 0;
            foreach ($params['item_details'] as $item) {
                $gross_amount += $item['quantity'] * $item['price'];
            }
            $payloads['transaction_details']['gross_amount'] = $gross_amount;
        }
        
        $payloads = array_replace_recursive($payloads, $params);
        
        if (Config::$isSanitized) {
            Sanitizer::jsonRequest($payloads);
        }
        
        $result = ApiRequestor::post(
            Config::getBaseUrl() . '/charge',
            Config::$serverKey,
            $payloads
        );
        
        return $result;
    }

    public static function token($credit_card)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => Config::getBaseUrl() . "/token?" . $credit_card,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Basic ' . base64_encode(Config::$serverKey . ':')
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return response()->json($response);
    }
}
