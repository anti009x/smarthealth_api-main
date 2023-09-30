<?php

namespace App\Http\Controllers\API\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Transaksi\TransaksiKonsultasi as TransaksiTransaksiKonsultasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiKonsultasi extends Controller
{
    public function store(Request $request)
    {
        return DB::transaction(function() use ($request) {

            $ahli = User::where("id", $request->ahli_id)->first();

            TransaksiTransaksiKonsultasi::create([
                "id_transaksi_konsultasi" => "TRN-K-" . date("YmdHis"),
                "konsumen_id" => Auth::user()->konsumen->id_konsumen,
                "nama" => Auth::user()->konsumen->getUsers->nama,
                "nomor_hp" => Auth::user()->konsumen->getUsers->nomor_hp,
                "ahli_id" => $request->ahli_id,
                "nama_ahli" => $ahli->nama,
                "nomor_hp_ahli" => $ahli->nomor_hp,
                "biaya_konsultasi" => $request->biaya_konsultasi,
                "pembayaran" => "Sudah Melakukan Pembayaran",
                "status" => 1
            ]);

            return response()->json(["pesan" => "Data Berhasil di Tambahkan"]);
        });
    }
}
