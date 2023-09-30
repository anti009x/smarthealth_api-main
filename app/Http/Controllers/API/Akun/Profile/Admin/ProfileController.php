<?php

namespace App\Http\Controllers\API\Akun\Profile\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Akun\Profil\Admin\GetProfilResource;
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

            $user = User::where("id", $id)->first();

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
                "alamat" => $request->alamat,
                "jenis_kelamin" => $request->jenis_kelamin,
                "usia" => $request->usia,
                "berat_badan" => $request->berat_badan,
                "tinggi_badan" => $request->tinggi_badan,
                "tempat_lahir" => $request->tempat_lahir,
                "tanggal_lahir" => $request->tanggal_lahir
            ]);

            return response()->json(["pesan" => "Data Profil Admin Berhasil di Simpan"]);
        });
    }
}
