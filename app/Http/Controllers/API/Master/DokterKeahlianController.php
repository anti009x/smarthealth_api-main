<?php

namespace App\Http\Controllers\API\Master;

use App\Http\Controllers\Controller;
use App\Http\Resources\Master\Keahlian\GetDokterKeahlianResource;
use App\Models\Master\DokterKeahlian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DokterKeahlianController extends Controller
{
    public function index()
    {
        return DB::transaction(function () {
            $dokter_keahlian = DokterKeahlian::orderBy("created_at", "DESC")->with("getKeahlian:id_keahlian,nama_keahlian")->paginate(10);

            return GetDokterKeahlianResource::collection($dokter_keahlian);
        });
    }

    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {

            foreach ($request->keahlian_id as $value) {
                DokterKeahlian::create([
                    "id_dokter_keahlian" => "DKTR-A-" . Str::random(10),
                    "dokter_id" => Auth::user()->getDokter->id_dokter,
                    "keahlian_id" => $value
                ]);
            }

            return response()->json(["pesan" => "Data Dokter Keahlian Berhasil di Tambahkan"]);
        });
    }

    public function edit($id_dokter_keahlian)
    {
        return DB::transaction(function () use ($id_dokter_keahlian) {
            $dokter_keahlian = DokterKeahlian::where("id_dokter_keahlian", $id_dokter_keahlian)->first();

            return new GetDokterKeahlianResource($dokter_keahlian);
        });
    }

    public function update(Request $request, $id_dokter_keahlian)
    {
        return DB::transaction(function () use ($request, $id_dokter_keahlian) {
            DokterKeahlian::where("id_dokter_keahlian", $id_dokter_keahlian)->update([
                "dokter_id" => $request->dokter_id,
                "keahlian_id" => $request->keahlian_id
            ]);

            return response()->json(["pesan" => "Data Dokter Keahlian Berhasil di Simpan"]);
        });
    }

    public function destroy($id_dokter_keahlian)
    {
        return DB::transaction(function () use ($id_dokter_keahlian) {
            DokterKeahlian::where("id_dokter_keahlian", $id_dokter_keahlian)->delete();

            return response()->json(["pesan" => "Data Dokter Keahlian Berhasil di Hapus"]);
        });
    }

    public function show($id_keahlian)
    {
        return DB::transaction(function () use ($id_keahlian) {
            $data_dokter = DokterKeahlian::where("keahlian_id", $id_keahlian)->with("getKeahlian:id_keahlian,nama_keahlian")->get();

            // if ($data_dokter->count() == 0) {
            //     return response()->json(["code" => 404]);
            // }

            return GetDokterKeahlianResource::collection($data_dokter);
        });
    }

    public function get_data_by_dokter($id_dokter)
    {
        return DB::transaction(function() use($id_dokter) {
            $dokter = DokterKeahlian::where("dokter_id", $id_dokter)->with("getDokter:id_dokter,user_id")->get();
            
            return GetDokterKeahlianResource::collection($dokter);
        });
    }
}
