<?php

namespace App\Http\Controllers\API\Akun\Profile\Dokter;

use App\Http\Controllers\Controller;
use App\Http\Resources\Akun\Profil\Dokter\GetProfilResource;
use App\Models\Ahli\BiayaPraktek;
use App\Models\Akun\Dokter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    protected $user_id;

    public function get_profil()
    {
        return DB::transaction(function () {
            $user = Dokter::where("user_id", Auth::user()->id)->with("getUser:id,nama,email,nomor_hp,alamat,status")->first();

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

            Dokter::where("user_id", $this->user_id)->update([
                "nomor_str" => $request->nomor_str
            ]);

            BiayaPraktek::where("ahli_id", $this->user_id)->update([
                "biaya" => $request->biaya
            ]);

            return response()->json(["pesan" => "Data Profil Dokter Berhasil di Simpan"]);
        });
    }
}
