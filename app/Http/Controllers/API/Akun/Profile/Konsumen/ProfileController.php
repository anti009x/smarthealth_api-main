<?php

namespace App\Http\Controllers\API\Akun\Profile\Konsumen;

use App\Http\Controllers\Controller;
use App\Http\Resources\Akun\Profil\Konsumen\GetProfilResource;
use App\Http\Resources\Akun\Profil\Konsumen\GetSaldoResource;
use App\Models\Akun\Konsumen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    protected $user_id;

    public function get_profil()
    {
        $this->user_id = Auth::user()->id;

        return DB::transaction(function () {
            $id = $this->user_id;

            $user = Konsumen::with("getUsers:id,nama,email,nomor_hp,alamat,jenis_kelamin,usia,berat_badan,tinggi_badan,tempat_lahir,tanggal_lahir")->where("user_id", $id)->first();

            return new GetProfilResource($user);
        });
    }

    public function update_profil(Request $request)
    {
        $this->user_id = Auth::user()->id;

        return DB::transaction(function () use ($request) {

            Konsumen::where("user_id", $this->user_id)->update([
                "nik" => $request->nik
            ]);

            User::where("id", $this->user_id)->update([
                "nama" => $request->nama,
                "email" => $request->email,
                "nomor_hp" => $request->nomor_hp,
                "alamat" => $request->alamat,
                "jenis_kelamin" => $request->jenis_kelamin,
                "usia" => $request->usia,
                "berat_badan" => $request->berat_badan,
                "tinggi_badan" => $request->tinggi_badan,
                "tempat_lahir" => $request->tempat_lahir,
                "tanggal_lahir" => $request->tanggal_lahir
            ]);

            return response()->json(["pesan" => "Data Profil Konsumen Berhasil di Simpan"]);
        });
    }

    public function get_saldo()
    {
        $this->user_id = Auth::user()->id;

        return DB::transaction(function () {
            $id = $this->user_id;

            $user = User::where("id", $id)->first();

            return new GetSaldoResource($user);
        });
    }

    public function update_saldo(Request $request)
    {
        $this->user_id = Auth::user()->id;

        return DB::transaction(function () use ($request) {
            $id = $this->user_id;

            User::where("id", $id)->update([
                "saldo" => $request->saldo,
                "biaya_admin" => 2000
            ]);

            return response()->json(["pesan" => "Data Saldo Berhasil di Ubah"]);
        });
    }

    public function update_uid(Request $request)
    {
        return DB::transaction(function () use ($request) {
            User::where("id", $request["id"])->update([
                "uuid_firebase" => $request["uuid_firebase"]
            ]);

            return response()->json(["pesan" => "Data Berhasil di Simpan"]);
        });
    }
}
