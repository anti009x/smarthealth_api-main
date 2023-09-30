<?php

namespace App\Http\Controllers\API\Akun\Profile\Apotek;

use App\Http\Controllers\Controller;
use App\Http\Resources\Akun\Profil\Apotek\GetProfilResource;
use App\Models\Akun\Dokter;
use App\Models\Akun\OwnerApotek;
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

            $user = OwnerApotek::where("user_id", $id)->with("getUser:id,nama,email,nomor_hp,alamat,status")->first();

            return new GetProfilResource($user);
        });
    }

    public function update_profil(Request $request)
    {
        $this->user_id = Auth::user()->id;

        return DB::transaction(function () use ($request) {

            User::where("id", $this->user_id)->update([
                "nama" => $request->nama,
                "email" => $request->email,
                "nomor_hp" => $request->nomor_hp,
                "alamat" => $request->alamat
            ]);

            return response()->json(["pesan" => "Data Profil Apotek Berhasil di Simpan"]);
        });
    }
}
