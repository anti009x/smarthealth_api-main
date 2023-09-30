<?php

namespace App\Http\Controllers\API\Master\Artikel;

use App\Http\Controllers\Controller;
use App\Http\Resources\Artikel\Master\GroupingArtikel\GetGroupingArtikelResource;
use App\Models\Artikel\GroupingArtikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupingArtikelController extends Controller
{
    public function index(Request $request)
    {
        return DB::transaction(function () use($request) { 
            $grouping = GroupingArtikel::orderBy("created_at", "DESC")->paginate($request->per_page);

            return GetGroupingArtikelResource::collection($grouping);
        });
    }

    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {
            GroupingArtikel::create([
                "id_grouping_artikel" => "GRO-A" . date("YmdHis"),
                "id_artikel" => $request->id_artikel,
                "id_kategori_artikel" => $request->id_kategori_artikel
            ]);

            return response()->json(["pesan" => "Data Grouping Artikel Berhasil di Tambahkan"]);
        });
    }

    public function edit($id_grouping_artikel)
    {
        return DB::transaction(function () use ($id_grouping_artikel) {
            $grouping_artikel = GroupingArtikel::where("id_grouping_artikel", $id_grouping_artikel)->with("getArtikel:id_artikel,judul_artikel")->with("getKategoriArtikel:id_kategori_artikel,nama_kategori")->first();

            return new GetGroupingArtikelResource($grouping_artikel);
        });
    }

    public function update(Request $request, $id_grouping_artikel)
    {
        return DB::transaction(function () use ($id_grouping_artikel, $request) {

            GroupingArtikel::where("id_grouping_artikel", $id_grouping_artikel)->update([
                "id_artikel" => $request->id_artikel,
                "id_kategori_artikel" => $request->id_kategori_artikel
            ]);

            return response()->json(["pesan" => "Data Grouping Artikel Berhasil di Simpan"]);
        });
    }

    public function destroy($id_grouping_artikel)
    {
        return DB::transaction(function () use ($id_grouping_artikel) {

            GroupingArtikel::where("id_grouping_artikel", $id_grouping_artikel)->delete();

            return response()->json(["pesan" => "Data Grouping Artikel Berhasil di Hapus"]);
        });
    }

    public function list_by_artikel($id_artikel)
    {
        return DB::transaction(function() use($id_artikel) {
            $artikel = GroupingArtikel::where("id_artikel", $id_artikel)->get();

            return GetGroupingArtikelResource::collection($artikel);
        });
    }

    public function list_artikel_kategori($id_kategori_artikel)
    {
        return DB::transaction(function() use ($id_kategori_artikel) {
            $artikel = GroupingArtikel::where("id_kategori_artikel", $id_kategori_artikel)->get();

            return GetGroupingArtikelResource::collection($artikel);
        });
    }
}
