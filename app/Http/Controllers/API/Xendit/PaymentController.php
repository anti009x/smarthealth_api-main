<?php

namespace App\Http\Controllers\API\Xendit;

use App\Http\Controllers\Controller;
use App\Models\TestingPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Xendit\Xendit;

class PaymentController extends Controller
{
    protected $setApiKey;

    public function __construct()
    {
        $this->setApiKey = "xnd_development_QOi9zsTa9TMIItjscrZtfTyJxATb0JUqUg92TqrRGrgvOzXAAsCafr01YbY";
    }

    public function get_list()
    {
        Xendit::setApiKey($this->setApiKey);

        $getVaBanks = \Xendit\VirtualAccounts::getVABanks();

        $country = array_filter($getVaBanks, function($bank) {
            return $bank["is_activated"] === true;
        });

        $country = array_values($country);

        return response()->json(["data" => $country]);
    }

    public function post_va(Request $request)
    {
        Xendit::setApiKey($this->setApiKey);

        $external_id = "VA-" . date("YmdHis");

        $params = [
            "external_id" => $external_id,
            "bank_code" => $request->bank_code,
            "name" => $request->name,
            "expected_amount" => $request->expected_amount,
            "is_closed" => true,
            "expiration_date" => Carbon::now()->addDays(1)->toISOString(),
            "is_single_use" => true
        ];

        $simpan = TestingPayment::create([
            "external_id" => $external_id,
            "payment_channel" => "Virtual Account",
            "harga" => $request->expected_amount
        ]);

        $createVa = \Xendit\VirtualAccounts::create($params);

        return response()->json([
            "data" => $createVa
        ])->setStatusCode(200);
    }

    public function balance()
    {
        Xendit::setApiKey($this->setApiKey);

        $getBalance = \Xendit\Balance::getBalance('CASH');
        var_dump($getBalance);
    }

    public function callback(Request $request)
    {
        $external_id = $request->external_id;
        $status = $request->status;
        $pembayaran = TestingPayment::where("external_id", $external_id)->exists();

        if ($pembayaran) {
            if ($status == "ACTIVE") {
                $update = TestingPayment::where("external_id", $external_id)->update([
                    "status" => 1
                ]);
                if ($update > 0) {
                    return response()->json(["pesan" => "Data Berhasil di Simpan"]);
                }

                return response()->json(["pesan" => "Data Gagal di Simpan"]);
            }
        } else {
            return response()->json([
                "message" => "Data Tidak Ada"
            ]);
        }
    }
}
