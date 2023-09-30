<?php

namespace App\Http\Controllers\API\Master\Dokter;

use App\Http\Controllers\Controller;
use App\Http\Resources\Master\Dokter\JadwalPraktekResource;
use App\Models\Ahli\JadwalPraktek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalPraktekController extends Controller
{
    public function index()
    {
        return DB::transaction(function() {
            $jadwal = JadwalPraktek::get();

            return JadwalPraktekResource::collection($jadwal);
        });
    }

    public function store(Request $request)
    {
        return DB::transaction(function() use ($request) {
            JadwalPraktek::create([
                "id_jadwal_praktek_dokter" => "JDWL-P-" . date("YmdHis"),
                "id_detail_praktek" => $request->id_detail_praktek,
                "hari" => $request->hari,
                "mulai_jam" => $request->mulai_jam,
                "selesai_jam" => $request->selesai_jam
            ]);

            return response()->json(["pesan" => "Data Berhasil di Tambahkan"]);
        });
    }

    public function edit($id_jadwal_praktek_dokter)
    {
        return DB::transaction(function() use($id_jadwal_praktek_dokter) {
            echo $id_jadwal_praktek_dokter;
        });
    }
}
