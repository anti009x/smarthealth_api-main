<?php

namespace App\Http\Controllers\API\Akun\Public;

use App\Http\Controllers\Controller;
use App\Models\Ahli\BiayaPraktek;
use App\Models\Ahli\DetailPraktek;
use App\Models\Ahli\PraktekAhli;
use App\Models\Akun\Dokter;
use App\Models\Akun\OwnerApotek;
use App\Models\Akun\Perawat;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ActivateAccountController extends Controller
{
    public function active_account($id_user)
    {
        return DB::transaction(function () use ($id_user) {
            
            echo $id_user;
            
            die();
            $cek = User::where("id", $id_user)->first();
            
            User::where("id", $id_user)->update([
                "created_by" => Auth::user()->id,
                "status" => $cek->status == "1" ? "0" : "1"
            ]);
            
            
            return response()->json(["pesan" => "Status Akun Berhasil Diubah"]);
        });
    }
    
    public function active_account_status(Request $request, $id_user)
    {
        return DB::transaction(function() use ($request, $id_user) {
            
            $user = User::where("id", $id_user)->first();
            
            if ($user["id_role"] == "RO-2003062") {
                
                try {
                    
                    $messages = [
                        "required" => "Kolom :attribute Harus Diisi"
                    ];
                    
                    $this->validate($request, [
                        "nomor_str" => "required"
                    ], $messages);
                    
                    $dokter = Dokter::where("user_id", $user["id"])->first();
                    
                    $cek_nomor_str = $dokter->where("nomor_str", $request->nomor_str)->count();

                    if ($cek_nomor_str > 0) {
                        return response()->json(["status" => false, "pesan" => "Nomor STR Sudah Digunakan"]);
                    }

                    Dokter::where("id_dokter", $dokter["id_dokter"])->update([
                        "nomor_str" => $request->nomor_str
                    ]);
                } catch (ValidationException $e) {
                    return response()->json(["errors" => $e->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                }
                
            } else if($user["id_role"] == "RO-2003063") {
                try {

                    $messages = [
                        "required" => "Kolom :attribute Harus Diisi"
                    ];
                    
                    $this->validate($request, [
                        "nomor_strp" => "required"
                    ], $messages);
                    
                    $perawat = Perawat::where("user_id", $user["id"])->first();
                    
                    $cek_nomor_strp = $perawat->where("nomor_strp", $request->nomor_strp)->count();

                    if ($cek_nomor_strp > 0) {
                        return response()->json(["status" => false, "pesan" => "Nomor STRP Sudah Digunakan"]);
                    }

                    Perawat::where("id_perawat", $perawat["id_perawat"])->update([
                        "nomor_strp" => $request->nomor_strp
                    ]);
                } catch (ValidationException $e) {
                    return response()->json(["errors" => $e->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                }
            }
            
            if ($user["id_role"] == "RO-2003062") {
                try {
                    $messages = [
                        "required" => "Kolom :attribute Harus Diisi"
                    ];
                    
                    $this->validate($request, [
                        "is_dokter_rs" => "required"
                    ], $messages);
                    
                    if ($request["is_dokter_rs"] == "1") {

                        BiayaPraktek::where("ahli_id", $user["id"])->delete();

                        DetailPraktek::create([
                            "id_detail_praktek" => "JDWL-P-" . date("YmdHis"),
                            "ahli_id" => $user["id"],
                            "id_rumah_sakit" => $request["id_rumah_sakit"]
                        ]);

                        PraktekAhli::create([
                            "id_praktek_ahli" => "PR-A-" . date("YmdHis"),
                            "ahli_id" => $user["id"],
                            "id_rumah_sakit" => $request["id_rumah_sakit"]
                        ]);

                        User::where("id", $user["id"])->update([
                            "created_by" => Auth::user()->id,
                            "status" => "0"
                        ]);
                    } else if ($request["is_dokter_rs"] == "2") {
                        User::where("id", $user["id"])->update([
                            "created_by" => Auth::user()->id,
                            "status" => "1"
                        ]);
                    }
                    
                } catch (ValidationException $e) {
                    return response()->json(["errors" => $e->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                }
            } else {
                User::where("id", $user["id"])->update([
                    "created_by" => Auth::user()->id,
                    "status" => "1"
                ]);
            }
            
            return response()->json(["pesan" => "Data Berhasil di Simpan"]);
            
        });
    }
}
