<?php

namespace App\Http\Controllers\API\Master;

use App\Http\Controllers\Controller;
use App\Http\Resources\Master\Keahlian\GetKeahlianResource;
use App\Models\Master\KeahlianDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KeahlianDokterController extends Controller
{
    public function index()
    {
        return DB::transaction(function () {
            $keahlian = KeahlianDokter::orderBy("created_at", "DESC")->paginate(10);

            return GetKeahlianResource::collection($keahlian);
        });
    }

    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {

            if ($request->file("logo")) {
                $data = $request->file("logo")->store("keahlian");
            }

            KeahlianDokter::create([
                "id_keahlian" => "KHL-" . date("YmdHis"),
                "nama_keahlian" => $request->nama_keahlian,
                "logo" => url("/storage/" . $data),
                
            ]);

            return response()->json(["pesan" => "Data Berhasil di Tambahkan"]);
        });
    }

    public function edit($id_keahlian)
    {
        return DB::transaction(function () use ($id_keahlian) {
            $keahlian = KeahlianDokter::where("id_keahlian", $id_keahlian)->first();

            return new GetKeahlianResource($keahlian);
        });
    }

    public function update(Request $request, $id_keahlian)
    {
        return DB::transaction(function () use ($request, $id_keahlian) {

            if ($request->file("logo")) {
                if ($request->gambarLama) {
                    Storage::delete($request->gambarLama);
                }

                $nama_gambar = $request->file("logo")->store("keahlian");

                $data = url("/storage/" . $nama_gambar);
            } else {
                $data = url("") . "/storage/" . $request->gambarLama;
            }

            KeahlianDokter::where("id_keahlian", $id_keahlian)->update([
                "nama_keahlian" => $request->nama_keahlian,
                "logo" => $data
            ]);

            return response()->json(["pesan" => "Data Berhasil di Simpan"]);
        });
    }

    public function destroy($id_keahlian)
    {
        return DB::transaction(function () use ($id_keahlian) {

            $keahlian = KeahlianDokter::where("id_keahlian", $id_keahlian)->first();

            $data = str_replace(url("storage/"), "", $keahlian->logo);
            Storage::delete($data);

            $keahlian->delete();

            return response()->json(["pesan" => "Data Berhasil di Hapus"]);
        });
    }
}
