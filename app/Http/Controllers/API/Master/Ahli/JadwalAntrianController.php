<?php

namespace App\Http\Controllers\API\Master\Ahli;

use App\Http\Controllers\Controller;
use App\Http\Resources\Ahli\Antrian\GetAntrianResource;
use App\Http\Resources\Master\Ahli\GetJadwalAntrianResource;
use App\Models\Master\Dokter\JadwalAntrian;
use App\Models\Transaksi\RiwayatTransaksi;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class JadwalAntrianController extends Controller
{
    public function index()
    {
        return DB::transaction(function() {
            
            $cek = JadwalAntrian::where("konsumen_id", Auth::user()->konsumen->id_konsumen)->where("status", 1)->first();
            
            if (empty($cek)) {
                return response()->json(["status" => false, "message" => "Tidak Ada Antrian", "data" => []]);
            } else {
                $jadwal = JadwalAntrian::where("konsumen_id", Auth::user()->konsumen->id_konsumen)->where("status", 1)->first();
                
                return new GetJadwalAntrianResource($jadwal);
            }
            
            
        });
    }
    
    public function store(Request $request)
    {
        return DB::transaction(function() use ($request) {
            
            $ada = JadwalAntrian::where("status", 1)->where("konsumen_id", Auth::user()->konsumen->id_konsumen)->where("id_jadwal_praktek", $request->id_jadwal_praktek)->count();
            
            if ($ada > 0) {
                return response()->json(["status" => false, "pesan" => "Maaf, Anda Sudah Membuat Antrian Pada Jadwal Praktek Ini"]);
            } else {
                
                $jadwal = JadwalAntrian::create([
                    "id_jadwal_antrian" => "JDWL-A-" . date("YmdHis"),
                    "konsumen_id" => Auth::user()->konsumen->id_konsumen,
                    "id_jadwal_praktek" => $request->id_jadwal_praktek,
                    "status" => 1,
                    "tanggal" => date("Y-m-d")
                ]);
                
                $jadwal->update([
                    "qr_code" => QrCode::size(200)->generate(config("base_url.url") . $jadwal->id_jadwal_antrian)
                ]);
                
                return response()->json([
                    "status" => true,
                    "pesan" => "Data Berhasil di Tambahkan", 
                    "data" => [
                        "tanggal" => $jadwal["tanggal"]
                        ]
                    ]);
                }
            });
        }
        
        public function data_antrian()
        {
            return DB::transaction(function() {
                $logged_in = Auth::user()->id;
                
                $jadwal = JadwalAntrian::whereHas('jadwal_praktek', function($query) use ($logged_in) {
                    $query->whereHas('detail_praktek', function($subquery) use ($logged_in) {
                        $subquery->where('ahli_id', $logged_in);
                    });
                })->where("status", 1)->orderBy("id_jadwal_antrian", "ASC")->get();
                
                return GetAntrianResource::collection($jadwal);
            });
        }
        
        public function detail($id_jadwal_antrian)
        {
            return DB::transaction(function() use ($id_jadwal_antrian) {
                $jadwal_antrian = JadwalAntrian::where("id_jadwal_antrian", $id_jadwal_antrian)->first();
                
                return new GetAntrianResource($jadwal_antrian);
            });
        }
        
        public function update($id_jadwal_antrian)
        {
            return DB::transaction(function() use ($id_jadwal_antrian) {
                $jadwal_antrian = JadwalAntrian::withTrashed()->where("id_jadwal_antrian", $id_jadwal_antrian)->first();
               
                $convert = strtotime($jadwal_antrian->tanggal);
                $sekarang = strtotime(Carbon::now()->format("Y-m-d"));
                
                if ($sekarang < $convert) {
                    return response()->json(["status" => false, "pesan" => "Belum Waktunya Untuk Diselesaikan"]);
                }

                RiwayatTransaksi::create([
                    "id_transaksi_buat_janji" => "TRN-BJ-" . date("YmdHis"),
                    "konsumen_id" => $jadwal_antrian->konsumen_id,
                    "nama" => $jadwal_antrian->konsumen->getUsers->nama,
                    "nomor_hp" => $jadwal_antrian->konsumen->getUsers->nomor_hp,
                    "ahli_id" => $jadwal_antrian->jadwal_praktek->detail_praktek->ahli_id,
                    "nama_ahli" => $jadwal_antrian->jadwal_praktek->detail_praktek->user->nama,
                    "nomor_hp_ahli" => $jadwal_antrian->jadwal_praktek->detail_praktek->user->nomor_hp,
                    "foto_ahli" => null,
                    "biaya_praktek" => $jadwal_antrian->jadwal_praktek->detail_praktek->biaya_praktek,
                    "nama_rs" => $jadwal_antrian->jadwal_praktek->detail_praktek->rumah_sakit->nama_rs,
                    "tanggal_transaksi" => date("Y-m-d"),
                    "status" => 1
                ]);
                
                JadwalAntrian::where("id_jadwal_antrian", $id_jadwal_antrian)->update([
                    "status" => "0"
                ]);
                
                return response()->json(["message" => "Data Berhasil di Simpan"]);
            });
        }
        
        public function all()
        {
            return DB::transaction(function() {
                $cek = JadwalAntrian::where("konsumen_id", Auth::user()->konsumen->id_konsumen)->first();
                
                if (empty($cek)) {
                    return response()->json(["status" => false, "message" => "Tidak Ada Antrian", "data" => []]);
                } else {
                    $jadwal = JadwalAntrian::where("konsumen_id", Auth::user()->konsumen->id_konsumen)->where("status", 1)->get();
                    
                    return GetJadwalAntrianResource::collection($jadwal);
                }
            });
        }
        
        public function destroy($id_jadwal_antrian)
        {
            return DB::transaction(function() use ($id_jadwal_antrian) {
                $jadwal = JadwalAntrian::where("id_jadwal_antrian", $id_jadwal_antrian)->first();

                $jadwal->update([
                    "status" => "0"
                ]);

                $jadwal->delete();
                
                return response()->json(["pesan" => "Data Berhasil di Hapus"]);
            });
        }
    }
    