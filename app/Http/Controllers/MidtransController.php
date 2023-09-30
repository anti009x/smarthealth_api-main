<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MidtransController extends Controller
{
    private $filters;

    public function __construct()
    {
        $this->filters = array();
    }

    public static function jsonRequest(&$json)
    {
        $keys = array('item_details', 'customer_details');
        foreach ($keys as $key) {
            if (!array_key_exists($key, $json)) continue;

            $camel = static::upperCamelize($key);
            $function = "field$camel";
            static::$function($json[$key]);
        }
    }

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

    public function payment(Request $request)
    {
        try {
            $transaction = array(
                "payment_type" => "bank_transfer",
                "transaction_details" => [
                    "gross_amount" => 5000,
                    "order_id" => date("YmdHis")
                ],
                "customer_details" => [
                    "email" => "budi.utomo@Midtrans.com",
                    "first_name" => "budi",
                    "last_name" => "utomo",
                    "phone" => "+6281 1234 1234"
                ],
                "item_details" => [
                    "id" => "1388998298204",
                    "price" => 5000,
                    "quantity" => 1,
                    "name" => "Ayam Zozozo"
                ],
                "bank_transfer" => [
                    "bank" => "bca",
                    "va_number" => "11111"
                    ]
                );

            $charge = 
            } catch (\Throwable $th) {
                
            }
        }
    }
    