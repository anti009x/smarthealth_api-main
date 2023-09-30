<?php

namespace App\Http\Controllers\API\Autentikasi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Autentikasi\ValidatorLogin;
use App\Http\Requests\Autentikasi\ValidatorRegister;
use App\Models\Ahli\BiayaPraktek;
use App\Models\Akun\Dokter;
use App\Models\Akun\OwnerApotek;
use App\Models\Akun\OwnerRumahSakit;
use App\Models\Akun\Perawat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(ValidatorLogin $request)
    {
        $user = User::where("nomor_hp", $request->nomor_hp)->first();

        if (!$user) {
            return response()->json(
                ["pesan" => "Akun Tidak Terdaftar"],
                404
            );
        }

        if ($user->status != "1") {
            return response()->json(
                ["pesan" => "Akun Sedang Tidak Aktif"],
                404
            );
        }

        $cekPassword = Hash::check($request->password, $user->password);

        if (!$cekPassword) {
            return response()->json(
                ["pesan" => "Password Salah"],
                404
            );
        }

        $token = $user->createToken("api", [$user->getRole->nama_role]);

        Auth::login($user);

        $user['token'] = $token->plainTextToken;

        return response()->json(["message" => "Berhasil Login",  "data"=> $user]);
    }

    public function logout()
    {
        $user = Auth::user();

        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        return response()->json(["pesan" => "Anda Berhasil Logout"]);
    }

    public function register(ValidatorRegister $request)
    {
        return DB::transaction(function() use($request) {
            
            $user = User::where("nama", $request->nama)->count();

            if ($user > 0) {
                $count = User::max("id") + 1;

                $str_email = Str::slug($request->nama) . $count . "@gmail.com";

            } else {
                $str_email = Str::slug($request->nama) . "@gmail.com";
            }

            if ($request->file("foto")) {
                $data = $request->file("foto")->store("profil_user");
            }

            if ($request->file("file_dokumen")) {
                $dokumen = $request->file("file_dokumen")->store("dokumen");
            }

            if ($request->option == "dokter") {
                $role = "RO-2003062";
            } else if($request->option == "perawat") {
                $role = "RO-2003063";
            } else if($request->option == "rumah_sakit") {
                $role = "RO-2003066";
            } else if($request->option == "apotek") {
                $role = "RO-2003065";
            } else if ($request->option == "admin_apotek") {
                $role = "RO-2003067";
            }

            $user = User::create([
                "nama" => $request->nama,
                "email" => empty($request->email) ? $str_email : $request->email,
                "password" => bcrypt($request->password),
                "nomor_hp" => $request->nomor_hp,
                "id_role" =>  $role,
                "jenis_kelamin" => $request->jenis_kelamin,
                "foto" => url("storage/" . $data),
                "status" => "0"
            ]);

            if ($request->option == "dokter") {
                Dokter::create([
                    "id_dokter" => "DKTR-" . date("YmdHis"),
                    "user_id" => $user["id"],
                    "file_dokumen" => url("storage/".$dokumen)
                ]);

                BiayaPraktek::create([
                    "id_biaya_praktek" => "BIA-P-" . date("YmdHis"),
                    "ahli_id" => $user["id"],
                    "biaya" => empty($request->biaya_praktek) ? 0 : $request->biaya_praktek
                ]);
            } else if ($request->option == "perawat") {
                Perawat::create([
                    "id_perawat" => "PWT-" . date("YmdHis"),
                    "user_id" => $user["id"],
                    "file_dokumen" => url("storage/" . $dokumen)
                ]);

                BiayaPraktek::create([
                    "id_biaya_praktek" => "BIA-P-" . date("YmdHis"),
                    "ahli_id" => $user["id"],
                    "biaya" => 0 
                ]);
            } else if ($request->option == "rumah_sakit") {
                OwnerRumahSakit::create([
                    "id_owner_rumah_sakit" => "OWN-RS-" . date("YmdHis"),
                    "no_ktp" => $request->no_ktp,
                    "user_id" => $user["id"],
                    "file_dokumen" => url("storage/" . $dokumen)
                ]);
            } else if ($request->option == "apotek") {
                OwnerApotek::create([
                    "id_owner_apotek" => "OWN-" . date("YmdHis"),
                    "user_id" => $user["id"],
                    "file_dokumen" => url("storage/" . $dokumen)
                ]);
            }

            return response()->json(["pesan" => "Data Berhasil di Tambahkan"]);
        });
    }
}