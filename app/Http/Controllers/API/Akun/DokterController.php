<?php

namespace App\Http\Controllers\API\Akun;

use App\Http\Controllers\Controller;
use App\Http\Resources\Akun\Dokter\GetDokterResource;
use App\Models\Ahli\BiayaPraktek;
use App\Models\Ahli\DetailPraktek;
use App\Models\Akun\Dokter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DokterController extends Controller
{
    public function index()
    {
        return DB::transaction(function () {
            $dokter = Dokter::whereHas("getUser", function($query) {
                $query->where("status", "1");
            })->orderBy(DB::raw("RAND()"))->with("getUser:id,nama,email,jenis_kelamin,nomor_hp,alamat,tempat_lahir,tempat_lahir,tanggal_lahir,status")->with("getBiaya:id_biaya_praktek,ahli_id,biaya")->paginate(2);

            return GetDokterResource::collection($dokter);
        });
    }

    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {

            $user = User::create([
                "nama" => $request->nama,
                "email" => $request->email,
                "password" => bcrypt($request->password),
                "nomor_hp" => $request->nomor_hp,
                "alamat" => $request->alamat,
                "id_role" => "RO-2003062",
                "jenis_kelamin" => $request->jenis_kelamin,
                "usia" => $request->usia,
                "berat_badan" => $request->berat_badan,
                "tinggi_badan" => $request->tinggi_badan,
                "tanggal_lahir" => $request->tanggal_lahir,
                "status" => "0"
            ]);

            Dokter::create([
                "id_dokter" => "DOC-" . date("YmdHis"),
                "pendidikan_terakhir" => $request->pendidikan_terakhir,
                "nomor_str" => $request->nomor_str,
                "user_id" => $user->id,
                "kelas" => $request->kelas
            ]);

            BiayaPraktek::create([
                "id_biaya_praktek" => "BIA-P-" . date("YmdHis"),
                "ahli_id" => $user["id"],
                "biaya" => 0
            ]);

            return response()->json(["pesan" => "Data Dokter Berhasil di Tambahkan"]);
        });
    }

    public function edit($id)
    {
        return DB::transaction(function () use ($id) {
            $dokter = Dokter::where("id_dokter", $id)->with("getUser:id,nama,email,jenis_kelamin,nomor_hp,alamat,tempat_lahir,tanggal_lahir")->first();

            return new GetDokterResource($dokter);
        });
    }

    public function update(Request $request, $id_dokter)
    {
        return DB::transaction(function () use ($id_dokter, $request) {

            $dokter = Dokter::where("id_dokter", $id_dokter)->first();

            User::where("id", $dokter->user_id)->update([
                "nama" => $request->nama,
                "email" => $request->email,
                "nomor_hp" => $request->nomor_hp,
                "alamat" => $request->alamat,
                "jenis_kelamin" => $request->jenis_kelamin,
                "usia" => $request->usia,
                "berat_badan" => $request->berat_badan,
                "tinggi_badan" => $request->tinggi_badan,
                "tanggal_lahir" => $request->tanggal_lahir
            ]);

            Dokter::where("id_dokter", $id_dokter)->update([
                "nomor_str" => $request->nomor_str,
                "kelas" => $request->kelas
            ]);

            return response()->json(["pesan" => "Data Dokter Berhasil di Simpan"]);
        });
    }

    public function destroy($id_dokter)
    {
        return DB::transaction(function () use ($id_dokter) {

            $cek_data = Dokter::where("id_dokter", $id_dokter)->first();

            BiayaPraktek::where("ahli_id", $cek_data->ahli_id)->delete();
            User::where("id", $cek_data->user_id)->delete();

            $cek_data->delete();

            return response()->json(["pesan" => "Data Dokter Berhasil di Hapus"]);
        });
    }

    public function data()
    {
        return DB::transaction(function () {
            $masterdokter = Dokter::whereHas("getUser", function($query) {
                $query->where("status", 1);
            })->get();

            $data = [];
            foreach ($masterdokter as $item) {
                $detail_praktek = DetailPraktek::where("ahli_id", $item["user_id"])->first();

                if ($detail_praktek) {
                } else {
                    $data[] = [
                        "id_dokter" => $item["id_dokter"],
                        "user_id" => [
                            "id" => $item["getUser"]["id"],
                            "nama" => $item["getUser"]["nama"],
                            "email" => $item["getUser"]["email"],
                            "jenis_kelamin" => $item["getUser"]["jenis_kelamin"],
                            "nomor_hp" => $item["getUser"]["nomor_hp"],
                            "alamat" => $item["getUser"]["alamat"],
                            "tempat_lahir" => $item["getUser"]["tempat_lahir"],
                            "tanggal_lahir" => $item["getUser"]["tanggal_lahir"],
                            "status" => $item["getUser"]["status"],
                            "uid_firebase" => $item["getUser"]["uuid_firebase"],
                        ],
                        "nomor_str" => $item["nomor_str"],
                        "kelas" => $item["kelas"],
                        "biaya" => [
                            "id_biaya_praktek" => $item["getBiaya"]["id_biaya_praktek"],
                            "ahli_id" => $item["getBiaya"]["ahli_id"],
                            "biaya" => $item["getBiaya"]["biaya"],
                        ],
                        "file_dokumen" => $item["file_dokumen"],
                        "foto" => $item["foto"]
                    ];
                }
            }

            return response()->json(["data" => $data]);
        });
    }

    public function uid_partner($uid_partner)
    {
        return DB::transaction(function () use ($uid_partner) {
            $list = Dokter::where("id_dokter", $uid_partner)->get();

            return GetDokterResource::collection($list);
        });
    }
}
