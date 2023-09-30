<?php

namespace App\Http\Controllers\API\Master\Artikel;

use App\Http\Controllers\Controller;
use App\Http\Resources\Artikel\Master\DataArtikel\GetArtikelResource;
use App\Http\Resources\Artikel\Master\GroupingArtikel\GetGroupingArtikelResource;
use App\Models\Artikel\DataArtikel;
use App\Models\Artikel\GroupingArtikel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class DataArtikelController extends Controller
{
    public function index(Request $request)
    {
        return DB::transaction(function () use($request) {
            $artikel = DataArtikel::orderBy(DB::raw("RAND()"))->with("getUser:id,nama")->paginate($request->per_page);

            return GetArtikelResource::collection($artikel);
        });
    }

    public function store(Request $request)
    {
        return DB::transaction(function() use($request) {
            if ($request->file("foto")) {
                $data = $request->file("foto")->store("artikel");
            }

            DataArtikel::create([
                "id_artikel" => "ART-" . date("YmdHis"),
                "judul_artikel" => $request->judul_artikel,
                "slug_artikel" => Str::slug($request->judul_artikel),
                "foto" => url("storage/".$data),
                "deskripsi" => $request->deskripsi,
                "user_id" => Auth::user()->id
            ]);

            return response()->json(["pesan" => "Data Artikel Berhasil di Tambahkan"]);
        });
    }

    public function edit($id_artikel)
    {
        return DB::transaction(function () use ($id_artikel) {
            $artikel = DataArtikel::where("id_artikel", $id_artikel)->first();

            return new GetArtikelResource($artikel);
        });
    }

    public function update(Request $request, $id_artikel)
    {
        return DB::transaction(function () use ($id_artikel, $request) {

            if ($request->file("foto")) {
                if ($request->gambarLama) {
                    Storage::delete($request->gambarLama);
                }

                $nama_gambar = $request->file("foto")->store("artikel");

                $data = url("/storage/" . $nama_gambar);
            } else {
                $data = url('') . '/storage/' . $request->gambarLama;
            }

            DataArtikel::where("id_artikel", $id_artikel)->update([
                "judul_artikel" => $request->judul_artikel,
                "slug_artikel" => Str::slug($request->judul_artikel),
                "foto" => $data,
                "deskripsi" => $request->deskripsi,
            ]);

            return response()->json(["pesan" => "Data Artikel Berhasil di Simpan"]);
        });
    }

    public function destroy($id_artikel)
    {
        return DB::transaction(function () use ($id_artikel) {

            $artikel = DataArtikel::where("id_artikel", $id_artikel)->first();

            $data = str_replace(url('storage/'), "", $artikel->foto);
            Storage::delete($data);

            $artikel->delete();

            return response()->json(["pesan" => "Data Artikel Berhasil di Hapus"]);
        });
    }

    public function get_by_id($user_id)
    {
        return DB::transaction(function() use($user_id) {
            $artikel = DataArtikel::with("getUser:id,nama")->where("user_id", $user_id)->get();

            return GetArtikelResource::collection($artikel);
        });
    }

    public function get($id_artikel)
    {
        return DB::transaction(function() use($id_artikel) {
            $artikel = GroupingArtikel::where("id_artikel", $id_artikel)->get();

            return GetGroupingArtikelResource::collection($artikel);
        });
    }
}
