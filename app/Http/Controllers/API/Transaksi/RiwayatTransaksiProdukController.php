<?php

namespace App\Http\Controllers\API\Transaksi;

use App\Http\Controllers\Controller;
use App\Http\Resources\Transaksi\GetTransaksiProdukResource;
use App\Models\Master\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RiwayatTransaksiProdukController extends Controller
{
    public function index()
    {
        return DB::transaction(function() {
            $data = Transaksi::where("id_konsumen", Auth::user()->konsumen->id_konsumen)->get();
            
            return GetTransaksiProdukResource::collection($data);
        });
    }
}
