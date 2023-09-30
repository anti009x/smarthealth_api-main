<?php

namespace App\Http\Controllers\API\Akun\Public;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PictureController extends Controller
{
    public function update_picture(Request $request)
    {
        return DB::transaction(function () use ($request) {
            if ($request->file("picture")) {
                if (!empty($request->oldImage)) {
                    Storage::delete($request->oldImage);
                }

                $nama = $request->file("picture")->store("picture-user");

                $data = url('/storage/' . $nama);
            } else {
                $data = url('') . '/storage/' . $request->oldImage;
            }

            User::where("id", Auth::user()->id)->update([
                "foto" => $data
            ]);

            return response()->json(["pesan" => "Data Profil Berhasil di Simpan"]);
        });
    }
}
