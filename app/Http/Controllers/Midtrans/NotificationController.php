<?php

namespace App\Http\Controllers\Midtrans;

use App\Http\Controllers\Controller;
use App\Models\Midtrans\Invoice;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function post(Request $request)
    {
        try {
            $notification_body = json_decode($request->getContent(), true);

            $invoice = $notification_body["order_id"];
            $transaction_id = $notification_body["transaction_id"];
            $status_code = $notification_body["status_code"];
            $order = Invoice::where("invoice", $invoice)
                ->where("transaction_id", $transaction_id)
                ->first();

            if (!$order) {
                return ["code" => 0, "message" => "Terjadi Kesalahan"];
            }

            switch($status_code) {
                case '200' :
                    $order->status = "SUCCESS";
                    break;
                case '201' :
                    $order->status = "PENDING";
                    break;
                case '202' :
                    $order->status = "CANCEL";
                    break;
            }

            $order->save();

            return response()->json(["status" => 200, "message" => "Berhasil"])->header("Content-Type", "text/plain");

        } catch (\Exception $e) {
            dd($e);
            return response()->json(["status" => 404, "message" => "Error"])->header("Content-Type", "text/plain");
        }
    }
}
