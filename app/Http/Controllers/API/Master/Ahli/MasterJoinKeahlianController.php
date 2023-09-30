<?php

namespace App\Http\Controllers\API\Master\Ahli;

use App\Http\Controllers\Controller;
use App\Http\Resources\Master\Ahli\GetMasterKeahlianResource;
use App\Models\Ahli\MasterJoinKeahlian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterJoinKeahlianController extends Controller
{
    public function index()
    {
        return DB::transaction(function() {
            $master = MasterJoinKeahlian::with("user:id,nama,id_role,nomor_hp")->with("keahlian:id_keahlian,nama_keahlian")->orderBy("id_master_join_keahlian", "DESC")->get();

            return GetMasterKeahlianResource::collection($master);
        });
    }

    public function store(Request $request)
    {
        return DB::transaction(function() use($request) {
            MasterJoinKeahlian::create([
                "id_master_join_keahlian" => "MSTR-J-" . date("YmdHis"),
                "user_ahli_id" => $request->user_ahli_id,
                "keahlian_id" => $request->keahlian_id
            ]);

            return response()->json(["pesan" => "Data Berhasil di Tambahkan"]);
        });
    }

    public function edit($id_master_join_keahlian)
    {
        return DB::transaction(function() use($id_master_join_keahlian) {
            $master = MasterJoinKeahlian::with("user:id,nama,id_role,nomor_hp")->with("keahlian:id_keahlian,nama_keahlian")->where("id_master_join_keahlian", $id_master_join_keahlian)->first();

            return new GetMasterKeahlianResource($master);
        });
    }

    public function update(Request $request, $id_master_join_keahlian)
    {
        return DB::transaction(function() use($request, $id_master_join_keahlian) {
            MasterJoinKeahlian::where("id_master_join_keahlian", $id_master_join_keahlian)->update([
                "user_ahli_id" => $request->user_ahli_id,
                "keahlian_id" => $request->keahlian_id
            ]);

            return response()->json(["pesan" => "Data Berhasil di Simpan"]);
        });
    }

    public function destroy($id_master_join_keahlian)
    {
        return DB::transaction(function () use($id_master_join_keahlian) {
            MasterJoinKeahlian::where("id_master_join_keahlian", $id_master_join_keahlian)->delete();

            return response()->json(["pesan" => "Data Berhasil di Hapus"]);
        });
    }

    public function list_master($id_user)
    {
        return DB::transaction(function() use ($id_user) {
            $master = MasterJoinKeahlian::with("user:id,nama,id_role,nomor_hp")->with("keahlian:id_keahlian,nama_keahlian")->where("user_ahli_id", $id_user)->get();

            return GetMasterKeahlianResource::collection($master);
        });
    }
}
