<?php

namespace App\Http\Controllers\API\Master\RumahSakit;

use App\Http\Controllers\Controller;
use App\Http\Resources\Master\RumahSakit\RS\GetRumahSakitResource;
use App\Models\Akun\OwnerApotek;
use App\Models\Akun\OwnerRumahSakit;
use App\Models\Akun\RumahSakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DataRumahSakitController extends Controller
{
    protected $user_id;
    
    public function index(Request $request)
    {
        return DB::transaction(function () use($request) {
            $rs = RumahSakit::paginate($request->per_page);
            
            return GetRumahSakitResource::collection($rs);
        });
    }
    
    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {
            
            if ($request->file("foto_rs")) {
                $data = $request->file("foto_rs")->store("rumah_sakit");
            }
            
            RumahSakit::create([
                "id_rumah_sakit" => "RS-" . date("YmdHis"),
                "id_owner_rumah_sakit" => Auth::user()->getOwnerRs->id_owner_rumah_sakit,
                "nama_rs" => $request->nama_rs,
                "slug_rs" => Str::slug($request->nama_rs),
                "deskripsi_rs" => $request->deskripsi_rs,
                "kategori_rs" => 1,
                "alamat_rs" => $request->alamat_rs,
                "latitude" => $request->latitude,
                "longitude" => $request->longitude,
                "foto_rs" => url("storage/".$data)
            ]);
            
            return response()->json(["pesan" => "Data Akun Rumah Sakit Berhasil di Tambahkan"]);
        });
    }
    
    public function edit($id_rumah_sakit)
    {
        return DB::transaction(function () use ($id_rumah_sakit) {
            $rs = RumahSakit::where("id_rumah_sakit", $id_rumah_sakit)->first();
            return new GetRumahSakitResource($rs);
        });
    }
    
    public function update(Request $request, $id_rumah_sakit)
    {
        return DB::transaction(function () use ($request, $id_rumah_sakit) {
            
            if ($request->file("foto_rs")) {
                if ($request->gambarLama) {
                    $string = str_replace(url('storage/'), "", $request->gambarLama);
                    Storage::delete($string);
                }
                
                $nama_gambar = $request->file("foto_rs")->store("rumah_sakit");
                
                $data = url("storage/" . $nama_gambar);
            } else {
                $data = url('') . '/storage/' . $request->gambarLama;
            }
            
            RumahSakit::where("id_rumah_sakit", $id_rumah_sakit)->update([
                "nama_rs" => $request->nama_rs,
                "slug_rs" => Str::slug($request->nama_rs),
                "deskripsi_rs" => $request->deskripsi_rs,
                "kategori_rs" => 1,
                "alamat_rs" => $request->alamat_rs,
                "latitude" => $request->latitude,
                "longitude" => $request->longitude,
                "foto_rs" => $data
            ]);
            
            return response()->json(["pesan" => "Data Akun Rumah Sakit Berhasil di Simpan"]);
        });
    }
    
    public function destroy($id_rumah_sakit)
    {
        return DB::transaction(function () use ($id_rumah_sakit) {
            
            $rumah_sakit = RumahSakit::where("id_rumah_sakit", $id_rumah_sakit)->first();
            
            $data = str_replace(url('storage/'), "", $rumah_sakit->foto_rs);
            Storage::delete($data);
            
            $rumah_sakit->delete();
            
            return response()->json(["pesan" => "Data Akun Rumah Sakit Berhasil di Hapus"]);
        });
    }
    
    public function get_rs_by_id($id_user)
    {
        return DB::transaction(function () use ($id_user) {
            
            $owner = OwnerRumahSakit::where("user_id", $id_user)->first();
            
            $rs = RumahSakit::where("id_owner_rumah_sakit", $owner["id_owner_rumah_sakit"])->get();
            
            return GetRumahSakitResource::collection($rs);
        });
    }
    
    public function find_nearest(Request $request)
    {
        return DB::transaction(function () use ($request) {
            
            $lat = $request->latitude;
            $long = $request->longitude;
            
            $locations = RumahSakit::paginate(10);
            $data_rs = [];
            
            foreach ($locations as $lokasi) {
                $hitung_latitude_a = $lokasi->latitude * 3.14 / 180;
                $hitung_longitude_a = $lokasi->longitude * 3.14 / 180;
                
                $hitung_latitude_saya = $lat * 3.14 / 180;
                $hitung_longitude_saya = $long * 3.14 / 180;
                
                $selisih_a = $hitung_latitude_saya - $hitung_latitude_a;
                $selisih_b = $hitung_longitude_saya - $hitung_longitude_a;
                
                $hasil = pow(sin($selisih_a / 2), 2) + cos($lokasi->latitude) * cos($lat) * pow(sin($selisih_b / 2), 2);
                
                $sub_final = 2 * atan2(sqrt($hasil), sqrt(1 - $hasil));
                $final = 6371 * $sub_final;
                
                $data_rs[] = [
                    "id_rumah_sakit" => $lokasi->id_rumah_sakit,
                    "nama_rs" => $lokasi->nama_rs,
                    "latitude" => $lokasi->latitude,
                    "longitude" => $lokasi->longitude,
                    "kategori_rs" => $lokasi->kategori_rs,
                    "alamat_rs" => $lokasi->alamat_rs,
                    "foto_rs" => $lokasi->foto_rs,
                    "deskripsi_rs" => $lokasi->deskripsi_rs,
                    "distance" => $final,
                    "jarak" => floor($final)
                ];
            }
            
            usort($data_rs, function($a, $b) {
                return $a['distance'] - $b['distance'];
            });
            
            return response()->json(["data" => $data_rs]);
            
        });
    }
    
    public function all_find_nearest(Request $request)
    {
        $lat = $request->latitude;
        $long = $request->longitude;
        
        // $locations = DB::table('rumah_sakit')
        // ->select('id_rumah_sakit', 'nama_rs', 'latitude', 'longitude', 'kategori_rs', 'alamat_rs', 'foto_rs', 'deskripsi_rs')
        // ->selectRaw('(6371 * acos(cos(radians(' . $lat . ')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' . $long . ')) + sin(radians(' . $lat . ')) * sin(radians(latitude)))) AS distance')
        // ->orderBy('distance', 'ASC')
        // ->get()
        // ->map(function ($location) {
            //     $location->jarak = round($location->distance / 10, 1);
            //     return $location;
            // });
            
            // return response()->json($locations);
            
            $locations = RumahSakit::get();
            $data_rs = [];
            
            foreach ($locations as $lokasi) {
                $hitung_latitude_a = $lokasi->latitude * 3.14 / 180;
                $hitung_longitude_a = $lokasi->longitude * 3.14 / 180;
                
                $hitung_latitude_saya = $lat * 3.14 / 180;
                $hitung_longitude_saya = $long * 3.14 / 180;
                
                $selisih_a = $hitung_latitude_saya - $hitung_latitude_a;
                $selisih_b = $hitung_longitude_saya - $hitung_longitude_a;
                
                $hasil = pow(sin($selisih_a / 2), 2) + cos($lokasi->latitude) * cos($lat) * pow(sin($selisih_b / 2), 2);
                
                $sub_final = 2 * atan2(sqrt($hasil), sqrt(1 - $hasil));
                $final = 6371 * $sub_final;
                
                $data_rs[] = [
                    "id_rumah_sakit" => $lokasi->id_rumah_sakit,
                    "nama_rs" => $lokasi->nama_rs,
                    "latitude" => $lokasi->latitude,
                    "longitude" => $lokasi->longitude,
                    "kategori_rs" => $lokasi->kategori_rs,
                    "alamat_rs" => $lokasi->alamat_rs,
                    "foto_rs" => $lokasi->foto_rs,
                    "deskripsi_rs" => $lokasi->deskripsi_rs,
                    "distance" => $final,
                    "jarak" => floor($final)
                ];
            }
            
            usort($data_rs, function($a, $b) {
                return $a['distance'] - $b['distance'];
            });
            
            return response()->json(["data" => $data_rs]);
        }
    }
    