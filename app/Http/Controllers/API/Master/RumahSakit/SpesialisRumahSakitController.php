<?php

namespace App\Http\Controllers\API\Master\RumahSakit;

use App\Http\Controllers\Controller;
use App\Http\Resources\Master\RumahSakit\Spesialis\GetSpesialisResource;
use App\Models\Master\RumahSakit\SpesialisRumahSakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpesialisRumahSakitController extends Controller
{
    public function index($id_rumah_sakit)
    {
        return DB::transaction(function () use ($id_rumah_sakit) {
            $spesialis = SpesialisRumahSakit::with("getSpesialisPenyakit:id_spesialis_penyakit,icon,nama_spesialis,slug_spesialis")->where("id_rumah_sakit", $id_rumah_sakit)->paginate(10);


            return GetSpesialisResource::collection($spesialis);
        });
    }

    public function store(Request $request, $id_rumah_sakit)
    {
        return DB::transaction(function() use($request, $id_rumah_sakit) {
            SpesialisRumahSakit::create([
                "id_spesialis" => "SPS-RS-"  . date("YmdHis"),
                "id_rumah_sakit" => $id_rumah_sakit,
                "id_penyakit" => $request->id_penyakit
            ]);

            return response()->json(["pesan" => "Data Berhasil di Tambahkan"]);
        });
    }
    
    public function edit($id_rumah_sakit, $id_spesialis)
    {
        return DB::transaction(function() use ($id_rumah_sakit, $id_spesialis) {
            $spesialis = SpesialisRumahSakit::with("getSpesialisPenyakit:id_penyakit,icon,nama_spesialis,slug_spesialis,logo")->where("id_spesialis", $id_spesialis)->where("id_rumah_sakit", $id_rumah_sakit)->first();

            return new GetSpesialisResource($spesialis);
        });
    }

    public function update(Request $request, $id_spesialis)
    {
        return DB::transaction(function () use($request, $id_spesialis) {
            SpesialisRumahSakit::where("id_spesialis", $id_spesialis)->update([
                "id_penyakit" => $request->id_penyakit
            ]);

            return response()->json(["pesan" => "Data Berhasil di Simpan"]);
        });
    }

    public function destroy($id_spesialis)
    {
        return DB::transaction(function() use($id_spesialis) {
            SpesialisRumahSakit::where("id_spesialis", $id_spesialis)->delete();

            return response()->json(["pesan" => "Data Berhasil di Hapus"]);
        });
    }
}
