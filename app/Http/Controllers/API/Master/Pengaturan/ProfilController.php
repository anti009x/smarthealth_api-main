<?php

namespace App\Http\Controllers\API\Master\Pengaturan;

use App\Http\Controllers\Controller;
use App\Http\Resources\Master\Pengaturan\Profil\GetProfilResource;
use App\Models\Master\Pengaturan\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfilController extends Controller
{
    public function index()
    {
        return DB::transaction(function () {
            $profil = Profil::first();

            return response()->json(["pesan" => $profil]);
        });
    }

    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {
            Profil::create([
                "id_profil" => "PRF-" . date("YmdHis"),
                "singkatan" => $request->singkatan,
                "nama_profil" => $request->nama_profil,
                "nomor_hp" => $request->nomor_hp,
                "alamat" => $request->alamat,
                "deskripsi_profil" => $request->deskripsi_profil
            ]);
            return response()->json(["pesan" => "Data Profil Berhasil di Tambahkan"]);
        });
    }

    public function edit($id_profil)
    {
        return DB::transaction(function () use ($id_profil) {
            $profil = Profil::where("id_profil", $id_profil)->first();

            return response()->json(["data" => $profil]);
        });
    }

    public function update(Request $request, $id_profil)
    {
        return DB::transaction(function () use ($request, $id_profil) {
            Profil::where("id_profil", $id_profil)->update([
                "singkatan" => $request->singkatan,
                "nama_profil" => $request->nama_profil,
                "nomor_hp" => $request->nomor_hp,
                "alamat" => $request->alamat,
                "deskripsi_profil" => $request->deskripsi_profil
            ]);

            return response()->json(["pesan" => "Data Profil Berhasil di Simpan"]);
        });
    }

    public function destroy($id_profil)
    {
        return DB::transaction(function () use ($id_profil) {
            Profil::where("id_profil", $id_profil)->delete();

            return response()->json(["pesan" => "Data Profil Berhasil di Hapus"]);
        });
    }
}
