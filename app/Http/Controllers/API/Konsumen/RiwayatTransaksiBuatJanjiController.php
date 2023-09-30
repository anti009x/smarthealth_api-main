<?php

namespace App\Http\Controllers\API\Konsumen;

use App\Http\Controllers\Controller;
use App\Http\Resources\Konsumen\RiwayatTransaksi\BuatJanji\GetRiwayatTransaksiBuaJanjiResource;
use App\Models\Transaksi\RiwayatTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RiwayatTransaksiBuatJanjiController extends Controller
{
    public function index()
    {
        return DB::transaction(function() {
            $data = RiwayatTransaksi::where("konsumen_id", Auth::user()->konsumen->id_konsumen)->orderBy("tanggal_transaksi", "DESC")->get();

            return GetRiwayatTransaksiBuaJanjiResource::collection($data);
        });
    }

    public function show($id)
    {
        return DB::transaction(function() use ($id) {
            $data = RiwayatTransaksi::where("id_transaksi_buat_janji", $id)->first();

            return new GetRiwayatTransaksiBuaJanjiResource($data);
        });
    }

    public function transaksi_buat_janji()
    {
        return DB::transaction(function() {
            $data = RiwayatTransaksi::where("ahli_id", Auth::user()->getDokter->user_id)->get();

            return GetRiwayatTransaksiBuaJanjiResource::collection($data);
        });
    }
}
