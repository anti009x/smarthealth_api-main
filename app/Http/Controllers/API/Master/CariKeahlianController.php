<?php

namespace App\Http\Controllers\API\Master;

use App\Http\Controllers\Controller;
use App\Models\Ahli\Keahlian;
use App\Models\Ahli\MasterJoinKeahlian;
use App\Models\Master\DokterKeahlian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CariKeahlianController extends Controller
{
    public function index(Request $request)
    {
        return DB::transaction(function()  use($request) {
            $search = $request["nama_keahlian"];
            $role = $request["role"];

            $results = Keahlian::whereHas("master_keahlian", function ($query) use ($search) {
                $query->where("nama_keahlian", "LIKE", "%" . $search. '%');
            })->get();

            $data = [];

            if ($role == 0) {
                $idDokterArray = [];
                foreach ($results as $item) {
                    $master = MasterJoinKeahlian::where("keahlian_id", $item["id_keahlian"])->get();

                    foreach ($master as $masters) {
                        if ($masters["user"]["getDokter"]) {
                            $idDokter = $masters["user"]["getDokter"]["id_dokter"];

                            if (!in_array($idDokter, $idDokterArray)) {
                                $data[] = [
                                    "id_dokter" => $masters["user"]["getDokter"]["id_dokter"],
                                    "user_id" => [
                                        "id" => $masters["user"]["id"],
                                        "nama" => $masters["user"]["nama"],
                                        "email" => $masters["user"]["email"],
                                        "jenis_kelamin" => $masters["user"]["jenis_kelamin"],
                                        "nomor_hp" => $masters["user"]["nomor_hp"],
                                        "alamat" => $masters["user"]["alamat"]
                                    ]
                                ];

                                $idDokterArray[] = $idDokter;
                            }

                        }
                    }

                }
            } else if ($role == 1) {
                $idPerawatArray = [];
                foreach ($results as $item) {
                    $master = MasterJoinKeahlian::where("keahlian_id", $item["id_keahlian"])->get();

                    foreach ($master as $masters) {
                        if ($masters["user"]["getPerawat"]) {
                            $id_perawat = $masters["user"]["getPerawat"]["id_perawat"];

                            if (!in_array($id_perawat, $idPerawatArray)) {
                                $data[] = [
                                    "id_perawat" => $masters["user"]["getPerawat"]["id_perawat"],
                                    "user" => [
                                        "id" => $masters["user"]["id"],
                                        "nama" => $masters["user"]["nama"],
                                        "email" => $masters["user"]["email"],
                                        "jenis_kelamin" => $masters["user"]["jenis_kelamin"],
                                        "nomor_hp" => $masters["user"]["nomor_hp"],
                                        "alamat" => $masters["user"]["alamat"]
                                    ]
                                ];

                                $idPerawatArray[] = $id_perawat;
                            }

                        }
                    }

                }
            }


            return response()->json(["data" => $data, "status" => 200]);

        });
    }
}
