<?php

namespace App\Http\Controllers\Apotek\Pengaturan;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apotek\ProfilApotek\ValidatorProfilApotek;
use App\Http\Resources\Apotek\Pengaturan\ProfilApotekResource;
use App\Models\Apotek\Pengaturan\ProfilApotek;
use App\Models\Master\Pengaturan\Profil;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfilApotekController extends Controller
{
    public function index(Request $request)
    {
        return DB::transaction(function () use($request) {

            $profil = ProfilApotek::get();

            if (Auth::user()->id_role == "RO-2003065") {
                $profil = ProfilApotek::where("id_user", Auth::user()->id)
                    ->orderBy("created_at", "DESC")
                    ->with("getUser:id,nama")
                    ->paginate($request->per_page);
            } else if (Auth::user()->id_role == "RO-2003067") {
                $profil = ProfilApotek::where("user_penanggung_jawab_id", Auth::user()->id)
                    ->orderBy("created_at", "DESC")
                    ->with("getUser:id,nama")
                    ->paginate($request->per_page);
            }

            return ProfilApotekResource::collection($profil);
        });
    }

    public function store(ValidatorProfilApotek $request)
    {
        return DB::transaction(function () use ($request) {

            if ($request->file("foto_apotek")) {
                $data = $request->file("foto_apotek")->store("profil_apotek");
            }

            $user = User::create([
                "nama" => $request->nama,
                "email" => empty($request->email) ? Str::slug($request->nama) . "@gmail.com" : $request->email,
                "password" => bcrypt($request->password),
                "nomor_hp" => $request->nomor_hp,
                "id_role" => "RO-2003067",
                "created_by" => Auth::user()->id,
                "jenis_kelamin" => $request->jenis_kelamin,
                "status" => 1
            ]);

            ProfilApotek::create([
                "id_profil_apotek" => "PR-A-" . date("YmdHis"),
                "nama_apotek" => $request->nama_apotek,
                "slug_apotek" => Str::slug($request->nama_apotek),
                "deskripsi_apotek" => $request->deskripsi_apotek,
                "alamat_apotek" => $request->alamat_apotek,
                "nomor_hp_apotek" => $request->nomor_hp_apotek,
                "foto_apotek" => url("storage/".$data),
                "status" => 0,
                "id_user" => Auth::user()->id,
                "user_penanggung_jawab_id" => $user->id,
                "latitude" => $request->latitude,
                "longitude" => $request->longitude,
                "status" => 1
            ]);

            return response()->json(["pesan" => "Data Berhasil di Tambahkan"]);
        });
    }

    public function edit($id_profil_apotek)
    {
        return DB::transaction(function () use ($id_profil_apotek) {
            $keahlian = ProfilApotek::where("id_profil_apotek", $id_profil_apotek)->with("getUser:id,nama")->first();

            return new ProfilApotekResource($keahlian);
        });
    }

    public function update(ValidatorProfilApotek $request, $id_profil_apotek)
    {
        return DB::transaction(function () use ($request, $id_profil_apotek) {

            if ($request->file("foto_apotek")) {
                if ($request->gambarLama) {
                    Storage::delete($request->gambarLama);
                }

                $nama_gambar = $request->file("foto_apotek")->store("apotek");

                $data = url("/storage/" . $nama_gambar);
            } else {
                $data = url('') . '/storage/' . $request->gambarLama;
            }

            $profil_apotek = ProfilApotek::where("id_profil_apotek", $id_profil_apotek)->first();

            $profil_apotek->where("id_profil_apotek", $id_profil_apotek)->update([
                "nama_apotek" => $request->nama_apotek,
                "slug_apotek" => Str::slug($request->nama_apotek),
                "deskripsi_apotek" => $request->deskripsi_apotek,
                "alamat_apotek" => $request->alamat_apotek,
                "nomor_hp_apotek" => $request->nomor_hp_apotek,
                "foto_apotek" => $data,
                "latitude" => $request->latitude,
                "longitude" => $request->longitude
            ]);

            User::where("id", $profil_apotek->user_penanggung_jawab_id)->update([
                "nama" => $request->nama,
                "email" => empty($request->email) ? Str::slug($request->nama) : $request->email,
                "password" => bcrypt($request->password),
                "nomor_hp" => $request->nomor_hp,
                "id_role" => "RO-2003067",
                "jenis_kelamin" => $request->jenis_kelamin
            ]);

            return response()->json(["pesan" => "Data Berhasil di Simpan"]);
        });
    }

    public function destroy($id_profil_apotek)
    {
        return DB::transaction(function () use ($id_profil_apotek) {

            $profil_apotek = ProfilApotek::where("id_profil_apotek", $id_profil_apotek)->first();

            User::where("id", $profil_apotek->user_penanggung_jawab_id)->delete();

            $profil_apotek::where("id_profil_apotek", $id_profil_apotek)->delete();

            return response()->json(["pesan" => "Data Berhasil di Hapus"]);
        });
    }

    public function ubah_status($id_profil_apotek)
    {
        return DB::transaction(function () use ($id_profil_apotek) {
            $profil_apotek = ProfilApotek::where("id_profil_apotek", $id_profil_apotek)->first();

            if ($profil_apotek->status == 1) {
                $profil_apotek->status = 0;
            } else if ($profil_apotek->status == 0) {
                $profil_apotek->status = 1;
            }

            $profil_apotek->update();

            return response()->json(["pesan" => "Data Status Berhasil di Simpan"]);
        });
    }

    public function find_nearest(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $lat = $request->latitude;
            $long = $request->longitude;

            $locations = DB::table('profil_apotek')
                ->select('id_profil_apotek', 'nama_apotek', 'deskripsi_apotek', 'latitude', 'longitude', 'foto_apotek')
                ->selectRaw('(6371 * acos(cos(radians(' . $lat . ')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' . $long . ')) + sin(radians(' . $lat . ')) * sin(radians(latitude)))) AS distance')
                ->orderBy('distance', 'ASC')
                ->get();
                
                return response()->json(['data' => $locations]);

        });
    }
}
