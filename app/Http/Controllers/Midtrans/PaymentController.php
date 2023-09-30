<?php

namespace App\Http\Controllers\Midtrans;

use App\Http\Controllers\Controller;
use App\Models\Midtrans;
use App\Models\Transaksi\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    protected $serverKey = "SB-Mid-server-e2RCiK9QhAuL1L5MVMW3C40H";
    
    public function get_token($id_keranjang)
    {
        try {
            $cart = Keranjang::where("id_keranjang", $id_keranjang)->first();
            
            $first_name = Auth::user()->nama;
            $last_name = " member";
            $email = Auth::user()->email;
            $nomor_hp = Auth::user()->nomor_hp;
            $harga = $cart->jumlah_harga;
            
            \Midtrans\Config::$serverKey = env("MIDTRANS_SERVER_KEY");
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $params = array(
                'transaction_details' => array(
                    'order_id' => rand(),
                    'gross_amount' => $harga,
                ),
                'customer_details' => array(
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'phone' => $nomor_hp,
                ),
            );
    
            $snapToken = [];
    
            $snapToken[] = [
                "snap_token" => \Midtrans\Snap::getSnapToken($params)
            ];
    
            return response()->json($snapToken, 200);
            
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
        