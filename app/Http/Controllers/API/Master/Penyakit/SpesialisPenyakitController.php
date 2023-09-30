<?php

namespace App\Http\Controllers\API\Master\Penyakit;

use App\Http\Controllers\Controller;
use App\Http\Resources\Master\Penyakit\SpesialisPenyakit\GetSpesialisResource;
use App\Models\Master\Penyakit\SpesialisPenyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SpesialisPenyakitController extends Controller
{
    public function index()
    {
        return DB::transaction(function () {
            $spesialis_penyakit = SpesialisPenyakit::paginate(10);

            return GetSpesialisResource::collection($spesialis_penyakit);
        });
    }

    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {
            SpesialisPenyakit::create([
                "id_spesialis_penyakit" => "SPS-" . date("YmdHis"),
                "nama_spesialis" => $request->nama_spesialis,
                "icon" => $request->icon,
                "slug_spesialis" => Str::slug($request->nama_spesialis)
            ]);

            return response()->json(["pesan" => "Data Berhasil di Tambahkan"]);
        });
    }

    public function edit($id_spesialis_penyakit)
    {
        return DB::transaction(function () use ($id_spesialis_penyakit) {
            $spesialis_penyakit = SpesialisPenyakit::where("id_spesialis_penyakit", $id_spesialis_penyakit)->first();

            return new GetSpesialisResource($spesialis_penyakit);
        });
    }

    public function update(Request $request, $id_spesialis_penyakit)
    {
        return DB::transaction(function () use ($request, $id_spesialis_penyakit) {
            SpesialisPenyakit::where("id_spesialis_penyakit", $id_spesialis_penyakit)->update([
                "nama_spesialis" => $request->nama_spesialis,
                "icon" => $request->icon,
                "slug_spesialis" => Str::slug($request->nama_spesialis)
            ]);

            return response()->json(["pesan" => "Data Berhasil di Simpan"]);
        });
    }

    public function destroy($id_spesialis_penyakit)
    {
        return DB::transaction(function () use ($id_spesialis_penyakit) {
            SpesialisPenyakit::where("id_spesialis_penyakit", $id_spesialis_penyakit)->delete();

            return response()->json(["pesan" => "Data Berhasil di Hapus"]);
        });
    }
}
