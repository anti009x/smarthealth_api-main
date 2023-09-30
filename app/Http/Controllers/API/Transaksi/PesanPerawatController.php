<?php

namespace App\Http\Controllers\API\Transaksi;

use App\Http\Controllers\Controller;
use App\Http\Resources\Transaksi\GetTransaksiRawatJalanResource;
use App\Models\Transaksi\PesanPerawat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesanPerawatController extends Controller
{
    public function index()
    {
        try {
            $pesan = PesanPerawat::where("ahli_id", Auth::user()->nomor_hp)->get();

            return GetTransaksiRawatJalanResource::collection($pesan);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function store(Request $request)
    {
        try {
            PesanPerawat::create([
                "id_pesan_perawat" => "PSN-P-" . date("YmdHis"),
                "konsumen_id" => $request->konsumen_id,
                "ahli_id" => $request->ahli_id,
                "alamat" => "Indramayu, Celeng. Jawa Barat"
            ]);

            return response()->json(["pesan" => "Data Berhasil di Tambahka"]);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function update(Request $request, $id_pesan_perawat)
    {
        try {
            PesanPerawat::where("id_pesan_perawat", $id_pesan_perawat)->update([
                "status" => "1"
            ]);

            return response()->json(["pesan" => "Data Berhasil di Simpan"]);
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
