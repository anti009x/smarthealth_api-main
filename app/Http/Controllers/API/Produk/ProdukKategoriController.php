<?php

namespace App\Http\Controllers\API\Produk;

use App\Http\Controllers\Controller;
use App\Http\Resources\Apotek\Master\ProdukKategori\GetProdukKategoriResource;
use App\Models\Apotek\Produk\ProdukKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukKategoriController extends Controller
{
    public function index(Request $request)
    {
        return DB::transaction(function () use($request) {
            $produk_kategori = ProdukKategori::with("getProduk:id_produk,kode_produk,nama_produk,slug_produk,deskripsi_produk,harga_produk,foto_produk")->with("getKategori:id_kategori_produk,nama_kategori_produk")->paginate($request->per_page);

            return GetProdukKategoriResource::collection($produk_kategori);
        });
    }

    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {
            ProdukKategori::create([
                "id_produk_kategori" => "PRO-K-" . date("YmdHis"),
                "kode_produk" => $request->kode_produk,
                "id_kategori_produk" => $request->id_kategori_produk,
            ]);

            return response()->json(["pesan" => "Data Produk Kategori Berhasil di Tambahkan"]);
        });
    }

    public function edit($id_produk_kategori)
    {
        return DB::transaction(function () use ($id_produk_kategori) {
            $apotek = ProdukKategori::with("getProduk:id_produk,kode_produk,nama_produk,slug_produk,deskripsi_produk,harga_produk,foto_produk")->with("getKategori:id_kategori_produk,nama_kategori_produk")->where("id_produk_kategori", $id_produk_kategori)->first();

            return new GetProdukKategoriResource($apotek);
        });
    }

    public function update(Request $request, $id_produk_kategori)
    {
        return DB::transaction(function () use ($id_produk_kategori, $request) {

            ProdukKategori::where("id_produk_kategori", $id_produk_kategori)->update([
                "kode_produk" => $request->kode_produk,
                "id_kategori_produk" => $request->id_kategori_produk,
            ]);

            return response()->json(["pesan" => "Data Produk Kategori Berhasil di Simpan"]);
        });
    }

    public function destroy($id_produk_kategori)
    {
        return DB::transaction(function () use ($id_produk_kategori) {

            ProdukKategori::where("id_produk_kategori", $id_produk_kategori)->delete();

            return response()->json(["pesan" => "Data Produk Kategori Berhasil di Hapus"]);
        });
    }

    public function detail_by_kategori($id_kategori)
    {
        return DB::transaction(function() use ($id_kategori) {
            $data = ProdukKategori::where("id_kategori_produk", $id_kategori)->get();

            return GetProdukKategoriResource::collection($data);
        });
    }
}
