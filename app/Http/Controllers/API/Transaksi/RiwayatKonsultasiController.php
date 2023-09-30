<?php

namespace App\Http\Controllers\API\Transaksi;

use App\Http\Controllers\Controller;
use App\Http\Resources\Transaksi\GetRiwayatKonsultasiResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi\TransaksiKonsultasi;

class RiwayatKonsultasiController extends Controller
{
    public function index()
    {
        try {
            $data = TransaksiKonsultasi::get();
            
            return GetRiwayatKonsultasiResource::collection($data);
        } catch (\Exception $e){
            dd($e);
        }
    }
}
