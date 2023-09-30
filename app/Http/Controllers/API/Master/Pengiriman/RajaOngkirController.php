<?php

namespace App\Http\Controllers\API\Master\Pengiriman;

use App\Http\Controllers\Controller;
use App\Http\Resources\Master\RajaOngkir\GetKotaResource;
use App\Http\Resources\Master\RajaOngkir\GetProvinsiResource;
use App\Models\Master\RajaOngkir\Kota;
use App\Models\Master\RajaOngkir\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RajaOngkirController extends Controller
{
    public function get_provinsi()
    {
        return DB::transaction(function () {

            $provinsi = Provinsi::orderBy("id", "ASC")->get();

            return GetProvinsiResource::collection($provinsi);
        });
    }

    public function get_kota($province_id)
    {
        return DB::transaction(function () use ($province_id) {

            $kota = Kota::where("province_id", $province_id)->get();

            return GetKotaResource::collection($kota);
        });
    }
}
