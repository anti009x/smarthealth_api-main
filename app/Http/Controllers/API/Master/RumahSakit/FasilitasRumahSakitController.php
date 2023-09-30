<?php

namespace App\Http\Controllers\API\Master\RumahSakit;

use App\Http\Controllers\Controller;
use App\Http\Resources\Master\RumahSakit\Fasilitas\GetFasilitasResource;
use App\Models\Master\RumahSakit\FasilitasRumahSakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FasilitasRumahSakitController extends Controller
{
    public function index()
    {
        return DB::transaction(function () {
            $fasilitas = FasilitasRumahSakit::with("getRumahSakit:id_rumah_sakit,nama_rs")->orderBy("created_at", "DESC")->paginate(10);

            return GetFasilitasResource::collection($fasilitas);
        });
    }

    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {
            FasilitasRumahSakit::create([
                "id_fasilitas" => "FSL-" . date("YmdHis"),
                "id_rumah_sakit" => $request->id_rumah_sakit,
                "nama_fasilitas" => $request->nama_fasilitas
            ]);

            return response()->json(["pesan" => "Data Fasilitas Berhasil di Tambahkan"]);
        });
    }

    public function edit($id_fasilitas)
    {
        return DB::transaction(function () use ($id_fasilitas) {
            $fasilitas = FasilitasRumahSakit::with("getRumahSakit:id_rumah_sakit,nama_rs")->where("id_fasilitas", $id_fasilitas)->first();

            return new GetFasilitasResource($fasilitas);
        });
    }

    public function update(Request $request, $id_fasilitas)
    {
        return DB::transaction(function () use ($request, $id_fasilitas) {
            FasilitasRumahSakit::where("id_fasilitas", $id_fasilitas)->update([
                "id_rumah_sakit" => $request->id_rumah_sakit,
                "nama_fasilitas" => $request->nama_fasilitas
            ]);

            return response()->json(["pesan" => "Data Fasilitas Berhasil di Simpan"]);
        });
    }

    public function destroy($id_fasilitas)
    {
        return DB::transaction(function () use ($id_fasilitas) {
            FasilitasRumahSakit::where("id_fasilitas", $id_fasilitas)->delete();

            return response()->json(["pesan" => "Data Fasilitas Berhasil di Hapus"]);
        });
    }

    public function get_list_fasilitas($id_rumah_sakit)
    {
        return DB::transaction(function () use ($id_rumah_sakit) {
            $fasilitas = FasilitasRumahSakit::with("getRumahSakit:id_rumah_sakit,nama_rs")->where("id_rumah_sakit", $id_rumah_sakit)->get();

            return GetFasilitasResource::collection($fasilitas);
        });
    }
}
