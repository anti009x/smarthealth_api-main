<?php

namespace App\Http\Controllers\API\Xendit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Xendit\Xendit;

class XenditController extends Controller
{
    protected $setApiKey;

    public function __construct()
    {
        $this->setApiKey = "xnd_development_QOi9zsTa9TMIItjscrZtfTyJxATb0JUqUg92TqrRGrgvOzXAAsCafr01YbY";
    }

    public function list_bank()
    {
        Xendit::setApiKey($this->setApiKey);
        
        $getVaBanks = \Xendit\VirtualAccounts::getVABanks();

        $country = array_filter($getVaBanks, function($bank) {
            return $bank["is_activated"] === true;
        });

        $country = array_values($country);

        return response()->json(["data" => $country]);
    }
}
