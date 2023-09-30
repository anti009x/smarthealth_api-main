<?php

namespace App\Http\Controllers\API\Akun;

use App\Http\Controllers\Controller;
use App\Http\Resources\Akun\Apotek\GetOwnerApotekResource;
use App\Models\Akun\OwnerApotek;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OwnerApotekController extends Controller
{
    public function index()
    {
        return DB::transaction(function () {
            $apotek = OwnerApotek::orderBy("created_at", "DESC")->with("getUser:id,nama,email,nomor_hp,alamat,status")->paginate(10);

            return GetOwnerApotekResource::collection($apotek);
        });
    }

    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {

            $user = User::create([
                "nama" => $request->nama,
                "email" => $request->email,
                "password" => bcrypt("apotek"),
                "created_by" => Auth::user()->id,
                "token" => 0,
                "nomor_hp" => $request->nomor_hp,
                "alamat" => $request->alamat,
                "id_role" => "RO-2003065",
                "status" => '0'
            ]);

            OwnerApotek::create([
                "id_owner_apotek" => "OWN-" . date("YmdHis"),
                "user_id" => $user->id
            ]);

            return response()->json(["pesan" => "Data Owner Apotek Berhasil di Tambahkan"]);
        });
    }

    public function edit($id_owner_apotek)
    {
        return DB::transaction(function () use ($id_owner_apotek) {
            $apotek = OwnerApotek::where("id_owner_apotek", $id_owner_apotek)->first();

            return new GetOwnerApotekResource($apotek);
        });
    }

    public function update(Request $request, $id_owner_apotek)
    {
        return DB::transaction(function () use ($id_owner_apotek, $request) {

            $apotek = OwnerApotek::where("id_owner_apotek", $id_owner_apotek)->first();

            User::where("id", $apotek->user_id)->update([
                "nama" => $request->nama,
                "email" => $request->email,
                "nomor_hp" => $request->nomor_hp,
                "alamat" => $request->alamat,
            ]);

            return response()->json(["pesan" => "Data Owner Apotek Berhasil di Simpan"]);
        });
    }

    public function destroy($id_owner_apotek)
    {
        return DB::transaction(function () use ($id_owner_apotek) {

            OwnerApotek::where("id_owner_apotek", $id_owner_apotek)->delete();

            return response()->json(["pesan" => "Data Owner Apotek Berhasil di Hapus"]);
        });
    }
}
