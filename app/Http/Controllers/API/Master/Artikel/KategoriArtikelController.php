<?php

namespace App\Http\Controllers\API\Master\Artikel;

use App\Http\Controllers\Controller;
use App\Http\Resources\Artikel\Master\Kategori\GetKategoriArtikelResource;
use App\Models\Artikel\KategoriArtikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriArtikelController extends Controller
{
    public function index(Request $request)
    {
        return DB::transaction(function () use($request) {
            $kategori = KategoriArtikel::orderBy("created_at", "DESC")->paginate($request->per_page);

            return GetKategoriArtikelResource::collection($kategori);
        });
    }

    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {
            KategoriArtikel::create([
                "id_kategori_artikel" => "KT-A-" . date("YmdHis"),
                "nama_kategori" => $request->nama_kategori
            ]);

            return response()->json(["pesan" => "Data Kategori Artikel Berhasil di Tambahkan"]);
        });
    }

    public function edit($id_kategori_artikel)
    {
        return DB::transaction(function () use ($id_kategori_artikel) {
            $kategori = KategoriArtikel::where("id_kategori_artikel", $id_kategori_artikel)->first();

            return new GetKategoriArtikelResource($kategori);
        });
    }

    public function update(Request $request, $id_kategori_artikel)
    {
        return DB::transaction(function () use ($id_kategori_artikel, $request) {

            KategoriArtikel::where("id_kategori_artikel", $id_kategori_artikel)->update([
                "nama_kategori" => $request->nama_kategori
            ]);

            return response()->json(["pesan" => "Data Kategori Artikel Berhasil di Simpan"]);
        });
    }

    public function destroy($id_kategori_artikel)
    {
        return DB::transaction(function () use ($id_kategori_artikel) {

            KategoriArtikel::where("id_kategori_artikel", $id_kategori_artikel)->delete();

            return response()->json(["pesan" => "Data Kategori Artikel Berhasil di Hapus"]);
        });
    }
}
