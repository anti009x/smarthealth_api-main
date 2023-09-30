<?php

namespace App\Http\Controllers\API\Akun;

use App\Http\Controllers\Controller;
use App\Http\Resources\Akun\OwnerRs\GetOwnerRumahSakitResource;
use App\Models\Akun\OwnerRumahSakit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OwnerRumahSakitController extends Controller
{
    public function index()
    {
        return DB::transaction(function() {
            $data = OwnerRumahSakit::with("getUser:id,nama,email,nomor_hp,alamat")->orderBy("created_at", "DESC")->get();

            return GetOwnerRumahSakitResource::collection($data);
        });
    }

    public function store(Request $request)
    {
        return DB::transaction(function() use($request) {
            $user = User::create([
                "nama" => $request->nama,
                "email" => $request->email,
                "password" => bcrypt("owner_rs"),
                "nomor_hp" => $request->nomor_hp,
                "alamat" => $request->alamat,
                "id_role" => "RO-2003066",
                "created_by" => Auth::user()->id, 
            ]);

            OwnerRumahSakit::create([
                "id_owner_rumah_sakit" => "OWN-RS-" . date("YmdHis"),
                "no_ktp" => $request->no_ktp,
                "user_id" => $user["id"] 
            ]);

            return response()->json(["pesan" => "Data Berhasil di Tambahkan"]);
        });
    }

    public function edit($id_owner_rs)
    {
        return DB::transaction(function() use($id_owner_rs) {
            $owner = OwnerRumahSakit::with("getUser:id,nama,email,nomor_hp,alamat")->where("id_owner_rumah_sakit", $id_owner_rs)->first();
            
            return new GetOwnerRumahSakitResource($owner);
        });
    }

    public function update(Request $request, $id_owner_rs)
    {
        return DB::transaction(function() use($request, $id_owner_rs) {
            $ownerRumahSakit = OwnerRumahSakit::where("id_owner_rumah_sakit", $id_owner_rs)->first();
            $ownerRumahSakit->update([
                "no_ktp" => $request->no_ktp
            ]);

            $ownerRumahSakit->getUser()->update([
                "nama" => $request->nama,
                "email" => $request->email,
                "nomor_hp" => $request->nomor_hp,
                "alamat" => $request->alamat,
            ]);

            return response()->json(["pesan" => "Data Berhasil di Simpan"]);
        }); 
    }

    public function destroy($id_owner_rs)
    {
        return DB::transaction(function() use($id_owner_rs) {
            $owner = OwnerRumahSakit::where("id_owner_rumah_sakit", $id_owner_rs)->first();

            User::where("id", $owner["user_id"])->delete();

            $owner->delete();

            return response()->json(["pesan" => "Data Berhasil di Hapus"]);
        });
    }
}
