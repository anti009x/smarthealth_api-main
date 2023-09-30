<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Apotek\Produk\ProdukApotek;
use App\Models\Master\Obat\TransaksiObat;
use App\Models\Transaksi\Keranjang;
use App\Models\Transaksi\KeranjangDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DetailKeranjangController extends Controller
{
    public function hapus_semua_data()
    {
        return DB::transaction(function () {
            $keranjang = Keranjang::where("konsumen_id", Auth::user()->konsumen->id_konsumen)->first();

            $detail_keranjang = KeranjangDetail::where("keranjang_id", $keranjang["id_keranjang"])->get();
            
            foreach ($detail_keranjang as $d) {
                $d->delete();
            }

            $keranjang->delete();

            return response()->json(["pesan" => "Data Berhasil di Hapus"]);
        });
    }

    public function destroy($id_keranjang_detail)
    {
        return DB::transaction(function() use ($id_keranjang_detail) {
            $detail = KeranjangDetail::where("id_keranjang_detail", $id_keranjang_detail)->first();
            
            $keranjang = Keranjang::where("id_keranjang", $detail->keranjang_id)->first();
            
            $jumlah_akhir = $keranjang->jumlah_harga - $detail->jumlah_harga;
            
            $keranjang->update([
                "jumlah_harga" => $jumlah_akhir
            ]);
            
            $detail->delete();
            
            return response()->json(["pesan" => "Data Berhasil di Hapus"]);
        });
    }
    
    public function kurang($id_keranjang_detail)
    {
        return DB::transaction(function() use ($id_keranjang_detail) {
            $detail = KeranjangDetail::where("id_keranjang_detail", $id_keranjang_detail)->first();
            
            if (empty($detail)) {
                return response()->json(["pesan" => "Data Keranjang Detail Tidak Ada"]);   
            } else {
                $produk = ProdukApotek::where("id_produk", $detail->produk_id)->first();
                
                if ($detail->jumlah > 1) {
                    $detail->update([
                        "jumlah" => $detail->jumlah - 1,
                        "jumlah_harga" => $detail->jumlah_harga - $produk->harga_produk
                    ]);
                    
                    $keranjang = Keranjang::where("id_keranjang", $detail->keranjang_id)->first();
                    
                    $keranjang->update([
                        "jumlah_harga" => $keranjang->jumlah_harga - $detail->jumlah_harga
                    ]);
                    
                    return response()->json(["pesan" => "Produk Berhasil di Kurangkan"]);
                } else {
                    $keranjang = Keranjang::where("id_keranjang", $detail->keranjang_id)->first();
                    
                    $keranjang->update([
                        "jumlah_harga" => $keranjang->jumlah_harga - $detail->jumlah_harga
                    ]);
                    
                    $detail->delete();
                    
                    return response()->json(["pesan" => "Produk Berhasil di Kurangkan"]);
                }
            }
        });
    }

    public function tambah($id_keranjang_detail)
    {
        return DB::transaction(function() use ($id_keranjang_detail) {
            $detail = KeranjangDetail::where("id_keranjang_detail", $id_keranjang_detail)->first();
            
            $produk = ProdukApotek::where("id_produk", $detail->produk_id)->first();
            
            $detail->update([
                "jumlah" => $detail->jumlah + 1,
                "jumlah_harga" => $detail->jumlah_harga + $produk->harga_produk
            ]);

            $jumlah_harga_keranjang = KeranjangDetail::where("keranjang_id", $detail->keranjang_id)->sum("jumlah_harga");

            $keranjang = Keranjang::where("id_keranjang", $detail->keranjang_id)->first();

            $keranjang->update([
                "jumlah_harga" => $jumlah_harga_keranjang
            ]);
            
            return response()->json(["pesan" => "Produk Berhasil di Tambahkan"]);
        });
    }
}
