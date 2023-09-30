<?php

namespace App\Http\Controllers\API\Master\Ahli;

use App\Http\Controllers\Controller;
use App\Http\Resources\Master\Ahli\GetJadwalPraktekResource;
use App\Models\Ahli\DetailPraktek;
use App\Models\Ahli\JadwalPraktek;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class JadwalPraktekController extends Controller
{
    public function index(Request $request, $ahli_id, $id_rumah_sakit)
    {
        return DB::transaction(function() use ($request, $ahli_id, $id_rumah_sakit) {
            $detail = DetailPraktek::where("ahli_id", $ahli_id)->where("id_rumah_sakit", $id_rumah_sakit)->first();

            $jadwal = JadwalPraktek::where("id_detail_praktek", $detail['id_detail_praktek'])->whereMonth("tanggal", Carbon::now()->format("m"))->paginate($request->per_page);

            return GetJadwalPraktekResource::collection($jadwal);
        });
    }
    
    public function store(Request $request, $id_detail_praktek)
    {
        try {
            $messages = [
                "required" => "Kolom :attribute Harus Diisi"
            ];
    
            $this->validate($request, [
                "hari" => "required",
                "mulai_jam" => "required",
                "selesai_jam" => "required"
            ], $messages);
    
            return DB::transaction(function() use($request, $id_detail_praktek) {
                $hari = $request["hari"];
                
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
                
                $currentDate = $startDate->copy();
                
                if (JadwalPraktek::where('hari', $hari)
                ->where("id_detail_praktek", $id_detail_praktek)
                ->whereBetween('tanggal', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                ->exists()
                ) {
                    return response()->json(["pesan" => "Data Jadwal Praktek Dengan Hari {$hari} Sudah Tersedia Pada Bulan Ini."], 400);
                }
                
                $nomer = 0;
                while ($currentDate->lte($endDate) && $currentDate->month === $startDate->month) {
                    if ($currentDate->format('l') === $hari && $currentDate->gte(Carbon::now()->startOfDay())) {
                        $jadwal = new JadwalPraktek();
                        $jadwal->id_jadwal_praktek = "JDWL-P-" . date("YmdHis") . $nomer++;
                        $jadwal->id_detail_praktek = $id_detail_praktek;
                        $jadwal->hari = $hari;
                        $jadwal->tanggal = $currentDate->format('Y-m-d');
                        $jadwal->mulai_jam = $request["mulai_jam"];
                        $jadwal->selesai_jam = $request["selesai_jam"];
                        $jadwal->save();
                    }
                    
                    $currentDate->addDay();
                }
                
                return response()->json(["pesan" => "Data Berhasil di Tambahkan"]);
            });
        } catch (ValidationException $e) {
            return response()->json(["errors" => $e->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
    
    public function edit($id_jadwal_praktek)
    {
        return DB::transaction(function() use($id_jadwal_praktek) {
            $jadwal = JadwalPraktek::where("id_jadwal_praktek", $id_jadwal_praktek)->first();
            
            return new GetJadwalPraktekResource($jadwal);
        });
    }
    
    public function update(Request $request, $id_jadwal_praktek)
    {
        return DB::transaction(function() use($request, $id_jadwal_praktek) {
            JadwalPraktek::where("id_jadwal_praktek", $id_jadwal_praktek)->update([
                "tanggal" => $request->tanggal,
                "mulai_jam" => $request->mulai_jam,
                "selesai_jam" => $request->selesai_jam
            ]);
            
            return response()->json(["pesan" => "Data Berhasil di Simpan"]);
        });
    }
    
    public function destroy($id_jadwal_praktek)
    {
        return DB::transaction(function() use($id_jadwal_praktek) {
            JadwalPraktek::where("id_jadwal_praktek", $id_jadwal_praktek)->delete();
            
            return response()->json(["pesan" => "Data Berhasil di Hapus"]);
        });
    }
}
