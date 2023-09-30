<?php

namespace App\Http\Controllers\API\Akun;

use App\Http\Controllers\Controller;
use App\Http\Resources\Akun\Perawat\GetPerawatResource;
use App\Models\Akun\Perawat;
use App\Models\Master\Ahli\Rating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerawatController extends Controller
{
    public function index(Request $request)
    {
        return DB::transaction(function () use($request) {
            $perawat = Perawat::orderBy("created_at", "DESC")->with("getUser:id,nama,email,nomor_hp,alamat,jenis_kelamin,foto,usia,berat_badan,tinggi_badan,tempat_lahir,tanggal_lahir,status")->paginate($request->per_page);

            return GetPerawatResource::collection($perawat);
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
                "id_role" => "RO-2003063",
                "jenis_kelamin" => $request->jenis_kelamin,
                "usia" => $request->usia,
                "berat_badan" => $request->berat_badan,
                "tinggi_badan" => $request->tinggi_badan,
                "tempat_lahir" => $request->tempat_lahir,
                "tanggal_lahir" => $request->tanggal_lahir,
                "status" => "0"
            ]);

            Perawat::create([
                "id_perawat" => "PRWT-" . date("YmdHis"),
                "user_id" => $user->id,
                "nip" => $request->nip
            ]);

            return response()->json(["pesan" => "Data Perawat Berhasil di Tambahkan"]);
        });
    }

    public function edit($id)
    {
        return DB::transaction(function () use ($id) {
            $perawat = Perawat::where("id_perawat", $id)->with("getUser:id,nama,email,nomor_hp,alamat,jenis_kelamin,foto,usia,berat_badan,tinggi_badan,tempat_lahir,tanggal_lahir")->first();

            return new GetPerawatResource($perawat);
        });
    }

    public function update(Request $request, $id_perawat)
    {
        return DB::transaction(function () use ($id_perawat, $request) {

            $perawat = Perawat::where("id_perawat", $id_perawat)->first();

            User::where("id", $perawat->user_id)->update([
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

            Perawat::where("id_perawat", $id_perawat)->update([
                "nip" => $request->nip
            ]);

            return response()->json(["pesan" => "Data Perawat Berhasil di Simpan"]);
        });
    }

    public function destroy($id_perawat)
    {
        return DB::transaction(function () use ($id_perawat) {

            $cek_data = Perawat::where("id_perawat", $id_perawat)->first();

            User::where("id", $cek_data->user_id)->delete();

            $cek_data->delete();

            return response()->json(["pesan" => "Data Perawat Berhasil di Hapus"]);
        });
    }

    public function data()
    {
        return DB::transaction(function () {
            
            $perawat = Perawat::whereHas("getUser", function($query) {
                $query->where("status", "1");
            })->with("getUser:id,nama,email,nomor_hp,jenis_kelamin,foto,usia,uuid_firebase", "ratings")
                ->get()
                ->sortByDesc(function($perawat) {
                    $rating = $perawat->ratings->count();
                    $jumlah = $perawat->ratings->sum("star");
                    return $rating !== 0 ? $jumlah / $rating : 0;
                });
            
            return GetPerawatResource::collection($perawat);
        });
    }
}
