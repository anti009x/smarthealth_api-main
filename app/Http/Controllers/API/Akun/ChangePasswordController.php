<?php

namespace App\Http\Controllers\API\Akun;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChangePasswordController extends Controller
{
    public function change_password(Request $request)
    {
        return DB::transaction(function () use ($request) {
            if ($request->password_baru != $request->konfirmasi_password) {
                return response()->json(["pesan" => "Maaf, Konfirmasi Password Tidak Sesuai"]);
            } else {
                User::where("id", Auth::user()->id)->update([
                    "password" => bcrypt($request->password_baru)
                ]);

                return response()->json(["pesan" => "Berhasil, Password Berhasil di Perbaharui"]);
            }
        });
    }
}
