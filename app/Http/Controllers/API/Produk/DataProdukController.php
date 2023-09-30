<?php

namespace App\Http\Controllers\API\Produk;

use App\Http\Controllers\Controller;
use App\Http\Resources\Apotek\Master\Produk\GetProdukResource;
use App\Models\Apotek\Produk\ProdukApotek;
use App\Models\Master\Obat\TransaksiObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DataProdukController extends Controller
{
    public function index(Request $request)
    {
        return DB::transaction(function () use($request){
            $produk = ProdukApotek::paginate($request->per_page);
            
            $data = [];
            foreach ($produk as $p) {
                $transaksi_masuk = TransaksiObat::where("kode_produk", $p->kode_produk)->where("status", 1)->sum("qty");
                
                $transaksi_keluar = TransaksiObat::where("kode_produk", $p->kode_produk)->where("status", 0)->sum("qty");
                
                $total_stok = $transaksi_masuk - $transaksi_keluar;
                $data[] = [
                    "id" => $p["id_produk"],
                    "owner" => $p->getOwnerApotek->getUser->nama,
                    "nama_produk" => $p["nama_produk"],
                    "kode_produk" => $p["kode_produk"],
                    "slug_produk" => $p["slug_produk"],
                    "deskripsi_produk" => $p["deskripsi_produk"],
                    "harga" => $p["harga_produk"],
                    "harga_produk" => "Rp. " . number_format($p["harga_produk"]),
                    "foto_produk" => $p["foto_produk"],
                    "qty" => $total_stok
                ];
            }
            
            return response()->json([
                "data" => $data
            ]);
        });
    }
    
    public function store(Request $request)
    {

        return DB::transaction(function () use ($request) {
            
            if ($request->file("foto_produk")) {
                $data = $request->file("foto_produk")->store("produk");
            }

            ProdukApotek::create([
                "kode_produk" => "PRO-" . date("YmdHis"),
                "id_owner_apotek" => Auth::user()->getAdminApotek->getUser->getApotek->id_owner_apotek,
                "id_profil_apotek" => Auth::user()->getAdminApotek->id_profil_apotek,
                "nama_produk" => $request->nama_produk,
                "slug_produk" => Str::slug($request->nama_produk),
                "deskripsi_produk" => $request->deskripsi_produk,
                "harga_produk" => $request->harga_produk,
                "foto_produk" => url("storage/" . $data)
            ]);
            
            return response()->json(["pesan" => "Data Produk Berhasil di Tambahkan"]);
        });
    }
    
    public function edit($kode_produk)
    {
        return DB::transaction(function () use ($kode_produk) {
            $apotek = ProdukApotek::where("kode_produk", $kode_produk)->first();
            
            return new GetProdukResource($apotek);
        });
    }
    
    public function update(Request $request, $kode_produk)
    {
        return DB::transaction(function () use ($kode_produk, $request) {
            
            if ($request->file("foto_produk")) {
                if ($request->gambarLama) {
                    Storage::delete($request->gambarLama);
                }

                $nama_gambar = $request->file("foto_produk")->store("produk");

                $data = url("/storage/" . $nama_gambar);
            } else {
                $data = url('') . '/storage/' . $request->gambarLama;
            }

            ProdukApotek::where("kode_produk", $kode_produk)->update([
                "id_profil_apotek" => Auth::user()->getAdminApotek->id_profil_apotek,
                "nama_produk" => $request->nama_produk,
                "slug_produk" => Str::slug($request->nama_produk),
                "deskripsi_produk" => $request->deskripsi_produk,
                "harga_produk" => $request->harga_produk,
                "foto_produk" => $data
            ]);
            
            return response()->json(["pesan" => "Data Produk Berhasil di Simpan"]);
        });
    }
    
    public function destroy($kode_produk)
    {
        return DB::transaction(function () use ($kode_produk) {
            
            ProdukApotek::where("kode_produk", $kode_produk)->delete();
            
            return response()->json(["pesan" => "Data Produk Berhasil di Hapus"]);
        });
    }
    
    public function get_by_owner()
    {
        return DB::transaction(function() {
            $produk_by_owner = ProdukApotek::where("id_profil_apotek", Auth::user()->getAdminApotek->id_profil_apotek)->get();

            foreach ($produk_by_owner as $p) {
                $transaksi_masuk = TransaksiObat::where("kode_produk", $p->kode_produk)->where("status", 1)->sum("qty");
                
                $transaksi_keluar = TransaksiObat::where("kode_produk", $p->kode_produk)->where("status", 0)->sum("qty");

                $total_stok = $transaksi_masuk - $transaksi_keluar;
                
                $p->qty = $total_stok;
            }
            
            return GetProdukResource::collection($produk_by_owner);
        });
    }
    
    public function get_produk_by_owner($id_profil_apotek)
    {
        return DB::transaction(function() use($id_profil_apotek) {
            $produk = ProdukApotek::where("id_owner_apotek", Auth::user()->getApotek->id_owner_apotek)
            ->where("id_profil_apotek", $id_profil_apotek)
            ->get();
            
            return GetProdukResource::collection($produk);
        });
    }
    
    public function all()
    {
        return DB::transaction(function () {
            $produk = ProdukApotek::get();
            
            $data = [];
            foreach ($produk as $p) {
                $transaksi_masuk = TransaksiObat::where("kode_produk", $p->kode_produk)->where("status", 1)->sum("qty");
                
                $transaksi_keluar = TransaksiObat::where("kode_produk", $p->kode_produk)->where("status", 0)->sum("qty");
                
                $total_stok = $transaksi_masuk - $transaksi_keluar;
                $data[] = [
                    "id" => $p["id_produk"],
                    "owner" => $p->getOwnerApotek->getUser->nama,
                    "nama_produk" => $p["nama_produk"],
                    "kode_produk" => $p["kode_produk"],
                    "slug_produk" => $p["slug_produk"],
                    "deskripsi_produk" => $p["deskripsi_produk"],
                    "harga" => $p["harga_produk"],
                    "harga_produk" => "Rp. " . number_format($p["harga_produk"]),
                    "foto_produk" => $p["foto_produk"],
                    "qty" => $total_stok
                ];
            }
            
            return response()->json([
                "data" => $data
            ]);
        });
    }
}
