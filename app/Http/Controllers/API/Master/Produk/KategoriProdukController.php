<?php

namespace App\Http\Controllers\API\Master\Produk;

use App\Http\Controllers\Controller;
use App\Http\Resources\Master\Produk\KategoriProduk\GetKategoriResource;
use App\Models\Master\Produk\KategoriProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KategoriProdukController extends Controller
{
    public function index(Request $request)
    {
        return DB::transaction(function () use($request) {
            $kategori_produk = KategoriProduk::paginate($request->per_page);

            return GetKategoriResource::collection($kategori_produk);
        });
    }

    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {
            KategoriProduk::create([
                "id_kategori_produk" => "KT-P-" . date("YmdHis"),
                "nama_kategori_produk" => $request->nama_kategori_produk,
                "slug_kategori_produk" => Str::slug($request->nama_kategori_produk)
            ]);

            return response()->json(["pesan" => "Data Berhasil di Tambahkan"]);
        });
    }

    public function edit($id_kategori_produk)
    {
        return DB::transaction(function () use ($id_kategori_produk) {
            $kategori = KategoriProduk::where("id_kategori_produk", $id_kategori_produk)->first();

            return new GetKategoriResource($kategori);
        });
    }

    public function update(Request $request, $id_kategori_produk)
    {
        return DB::transaction(function () use ($request, $id_kategori_produk) {
            KategoriProduk::where("id_kategori_produk", $id_kategori_produk)->update([
                "nama_kategori_produk" => $request->nama_kategori_produk,
                "slug_kategori_produk" => Str::slug($request->nama_kategori_produk)
            ]);

            return response()->json(["pesan" => "Data Berhasil di Simpan"]);
        });
    }

    public function destroy($id_kategori_produk)
    {
        return DB::transaction(function () use ($id_kategori_produk) {
            KategoriProduk::where("id_kategori_produk", $id_kategori_produk)->delete();

            return response()->json(["pesan" => "Data Berhasil di Hapus"]);
        });
    }
}
