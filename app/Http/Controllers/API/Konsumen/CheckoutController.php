<?php

namespace App\Http\Controllers\API\Konsumen;

use App\Http\Controllers\Controller;
use App\Http\Resources\Konsumen\Checkout\GetRiwayatResource;
use App\Models\Transaksi\Pembelian;
use App\Models\Transaksi\PembelianBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        return DB::transaction(function() {
            $pembelian = Pembelian::where("konsumen_id", Auth::user()->konsumen->id_konsumen)->get();

            return GetRiwayatResource::collection($pembelian);
        });
    }

    public function store(Request $request)
    {
        return DB::transaction(function() use ($request) {
            $pembelian = Pembelian::create([
                "id_pembelian" => "PMBL-" . date("YmdHis"),
                "konsumen_id" => Auth::user()->konsumen->id_konsumen,
                "ongkir_id" => "500",
                "tanggal_pembelian" => date("Y-m-d H:i:s"),
                "total_pembelian" => "",
                "nama_kota" => "Bandung",
                "tarif" => 100000,
                "alamat_pengiriman" => $request["alamat_pengiriman"],
                "status_pembelian" => "PENDING"
            ]);

            foreach ($request["kode_produk"] as $key => $item) {
                PembelianBarang::create([
                    "id_pembelian_barang" => "PMBL-B-" . date("YmdHis") . "-" . $key,
                    "id_pembelian" => $pembelian["id_pembelian"],
                    "kode_produk" => $item,
                    "jumlah" => $request["jumlah"][$key],
                    "nama_barang" => $request["nama_barang"][$key],
                    "harga" => $request["harga"][$key]
                ]);
            }

            return response()->json(["pesan" => "Data Berhasil di Tambahkan"]);
        });
    }

    public function show($id_pembelian)
    {
        return DB::transaction(function() use ($id_pembelian) {
            echo "TEST";
        });
    }
}
