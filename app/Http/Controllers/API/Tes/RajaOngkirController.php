<?php

namespace App\Http\Controllers\API\Tes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class RajaOngkirController extends Controller
{
    public function index(Request $request)
    {
        $daftarProvinsi = RajaOngkir::ongkosKirim([
            "origin" => $request->city_origin,
            "destination" => $request->city_destination,
            "courier" => $request->courier,
            "weight" => $request->weight
        ])->get();


        $daftarCost = [];

        foreach ($daftarProvinsi[0]["costs"] as $cost) {
            $daftarCost[] = $cost;
        }

        return response()->json($daftarCost);

        // $daftarProvinsi = RajaOngkir::ongkosKirim([
        //     'origin'        => 155,     // ID kota/kabupaten asal
        //     'destination'   => 80,      // ID kota/kabupaten tujuan
        //     'weight'        => 1300,    // berat barang dalam gram
        //     'courier'       => 'jne'    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        // ])->get();
    }
}
