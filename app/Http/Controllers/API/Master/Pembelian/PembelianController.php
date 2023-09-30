<?php

namespace App\Http\Controllers\API\Master\Pembelian;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Midtrans\CoreApi;
use App\Http\Resources\Transaksi\GetPembelianBarangResource;
use App\Http\Resources\Transaksi\GetPembelianResource;
use App\Models\Apotek\Produk\ProdukApotek;
use App\Models\Midtrans\Invoice;
use App\Models\Transaksi\Keranjang;
use App\Models\Transaksi\KeranjangDetail;
use App\Models\Transaksi\Pembelian;
use App\Models\Transaksi\PembelianBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    public function index()
    {
        return DB::transaction(function() {

            if (empty(Auth::user()->konsumen->id_konsumen)) {
                return response()->json(["pesan" => "Data Tidak Ditemukan", "data" => []]);
            } else {
                $pembelian = Pembelian::where("konsumen_id", Auth::user()->konsumen->id_konsumen)->orderBy("created_at", "DESC")->get();
    
                return GetPembelianResource::collection($pembelian);
            }

        });
    }

    public function store(Request $request)
    {
        try {
            $result = null;
            $payment_method = $request->payment_method;
            $invoice = "INV-" . date("YmdHis");
            $keranjang = Keranjang::where("id_keranjang", $request->id_keranjang)->first();
            $total_amount = $keranjang["jumlah_harga"];

            $transaction = array
            (
                "transaction_details" => [
                    "gross_amount" => $total_amount,
                    "order_id" => $invoice
                ],
                "customer_details" => [
                    "email" => Auth::user()->email,
                    "first_name" => Auth::user()->nama,
                    "last_name" => "member",
                    "phone" => Auth::user()->nomor_hp
                ]
            );

            switch ($payment_method) {
                case "bank_transfer" :
                    $result = self::bankTransfer($request, $total_amount, $transaction);
                    break;

                // case "credit_card" :
                //     $result = self::creditCardCharge($order_id, $total_amount, $request->token_id, $transaction);
                //     break;
            }

            Invoice::create([
                "invoice" => $invoice,
                "id_jenis_transaksi" => $result["id_pembelian"],
                "transaction_id" => $result["transaksi_id"],
                "status" => "PENDING"
            ]);

            foreach ($request->id_keranjang_detail as $id_keranjang_detail) {
                $detail = KeranjangDetail::where("id_keranjang_detail", $id_keranjang_detail)->first();
                $produk = ProdukApotek::where("id_produk", $detail["produk_id"])->first();

                PembelianBarang::create([
                    "id_pembelian_barang" => "PMBL-B-".date("YmdHis") . $id_keranjang_detail,
                    "id_pembelian" => $result["id_pembelian"],
                    "kode_produk" => $produk["kode_produk"],
                    "jumlah" => $detail["jumlah"],
                    "nama_barang" => $produk["nama_produk"],
                    "harga" => $produk["harga_produk"]
                ]);

                // $detail->delete();
            }

            $convert = json_encode($result["result"], true);

            $va_number = json_decode($convert, true);

            return response()->json([
                "pesan" => "Data Berhasil di Tambahkan",
                "detail" => [
                    "transaksi" => [
                        "tanggal" => Carbon::createFromFormat("Y-m-d H:i:s", date("Y-m-d H:i:s"))->isoFormat("dddd, DD MMMM YYYY | HH:mm:ss"),
                        "pembelian" => $result["id_pembelian"],
                        "va_number" => $va_number["va_numbers"][0]["va_number"],
                        "total" => "Rp. " . number_format($keranjang["jumlah_harga"]),
                        "bank" => $request->bank
                    ],
                    "konsumen" => [
                        "nama" => Auth::user()->nama,
                        "nomor_hp" => Auth::user()->nomor_hp
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function show($id_pembelian)
    {
        return DB::transaction(function() use ($id_pembelian) {
            $detail = PembelianBarang::where("id_pembelian", $id_pembelian)->get();
            
            return GetPembelianBarangResource::collection($detail);
        });
    }

    public function edit($id_pembelian) {
        return DB::transaction(function() use ($id_pembelian) {
            $detail_keranjang = Pembelian::where("id_pembelian", $id_pembelian)->first();

            return new GetPembelianResource($detail_keranjang);
        });
    }

    static function bankTransfer(Request $request, $total_amount, $transaction_object)
    {
        try {
            $transaction = $transaction_object;
            $transaction["payment_type"] = "bank_transfer";
            $transaction["bank_transfer"] = [
                "bank" => $request->bank,
                "va_number" => "11111"
            ];

            $charge = CoreApi::charge($transaction);

            if (!$charge) {
                return ["code" => 0, "message" => "Terjadi Kesalahan"];
            }

            $keranjang = Keranjang::where("id_keranjang", $request->id_keranjang)->first();

            $pembelian = new Pembelian();
            $pembelian->id_pembelian = "PMBL-" . date("YmdHis");
            $pembelian->konsumen_id = Auth::user()->konsumen->id_konsumen;
            $pembelian->tanggal_pembelian = date("Y-m-d");
            $pembelian->total_pembelian = $keranjang->jumlah_harga;
            $pembelian->nama_kota = "Bandung";
            $pembelian->tarif = 5000;
            $pembelian->alamat_pengiriman = "Bandung";
            $pembelian->status_pembelian = "PENDING";
            
            if (!$pembelian->save()) {
                return false;
            }

            // $keranjang->delete();
            
            return ["code" => 1, "message" => "Success", "result" => $charge, "id_pembelian" => $pembelian->id_pembelian, "transaksi_id" => $charge->transaction_id, "va_numbers" => $charge];

        } catch (\Exception $e) {
            dd($e);
            return ["code" => 0, "message" => "Terjadi Kesalahan"];
        }
    }

    public function checkout(Request $request)
    {
        try {
            $json = json_decode($request->get("json"));

            $keranjang = Keranjang::where("id_keranjang", $json->id_keranjang)->first();

            $pembelian = new Pembelian();
            $pembelian->id_pembelian = "PMBL-" . date("YmdHis");
            $pembelian->konsumen_id = Auth::user()->konsumen->id_konsumen;
            $pembelian->tanggal_pembelian = date("Y-m-d");
            $pembelian->total_pembelian = $keranjang->jumlah_harga;
            $pembelian->nama_kota = "Bandung";
            $pembelian->tarif = 5000;
            $pembelian->alamat_pengiriman = "Bandung";
            $pembelian->status_pembelian = "PENDING";
            $pembelian->save();

            $detail_keranjang = KeranjangDetail::where("id_keranjang", $json->id_keranjang)->get();

            foreach ($detail_keranjang as $detail) {
                $produk = ProdukApotek::where("id_produk", $detail["produk_id"])->first();

                PembelianBarang::create([
                    "id_pembelian_barang" => "PMBL-B-".date("YmdHis") . $detail["id_keranjang_detail"],
                    "id_pembelian" => $pembelian["id_pembelian"],
                    "kode_produk" => $produk["kode_produk"],
                    "jumlah" => $detail["jumlah"],
                    "nama_barang" => $produk["nama_produk"],
                    "harga" => $produk["harga_produk"]
                ]);

                // $detail->delete();
            }

            return response()->json([
                "success" => true,
                "message" => "Berhasil Di Proses"
            ], 200);

        } catch (\Exception $e) {
            dd($e);
        }
    }
}
