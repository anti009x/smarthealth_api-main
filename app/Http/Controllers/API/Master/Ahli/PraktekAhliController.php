<?php

namespace App\Http\Controllers\API\Master\Ahli;

use App\Http\Controllers\Controller;
use App\Http\Resources\Master\Ahli\GetPraktekAhliResource;
use App\Models\Ahli\PraktekAhli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PraktekAhliController extends Controller
{
    public function index()
    {
        return DB::transaction(function() {
            $praktek_ahli = PraktekAhli::get();

            return GetPraktekAhliResource::collection($praktek_ahli);
        });
    }

    public function store(Request $request)
    {
        return DB::transaction(function() use($request) {
            PraktekAhli::create([
                "id_praktek_ahli" => "PR-A-" . date("YmdHis"),
                "ahli_id" => $request->ahli_id,
                "id_keahlian" => $request->id_keahlian,
                "id_spesialis" => $request->id_spesialis,
                "id_rumah_sakit" => $request->id_rumah_sakit
            ]);

            return response()->json(["pesan" => "Data Berhasil di Tambahkan"]);
        });
    }

    public function edit($id_praktek_ahli)
    {
        return DB::transaction(function() use($id_praktek_ahli) {
            $praktek = PraktekAhli::where("id_praktek_ahli", $id_praktek_ahli)->first();

            return new GetPraktekAhliResource($praktek);
        });
    }

    public function update(Request $request, $id_praktek_ahli)
    {
        return DB::transaction(function() use($request, $id_praktek_ahli) {
            PraktekAhli::where("id_praktek_ahli", $id_praktek_ahli)->update([
                "ahli_id" => $request->ahli_id,
                "id_keahlian" => $request->id_keahlian,
                "id_spesialis" => $request->id_spesialis,
                "id_rumah_sakit" => $request->id_rumah_sakit
            ]);

            return response()->json(["pesan" => "Data Berhasil di Simpan"]);
        });
    }

    public function destroy($id_praktek_ahli)
    {
        return DB::transaction(function() use($id_praktek_ahli) {
            PraktekAhli::where("id_praktek_ahli", $id_praktek_ahli)->delete();

            return response()->json(["pesan" => "Data Berhasil di Hapus"]);
        });
    }
}
