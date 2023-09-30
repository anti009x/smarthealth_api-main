<?php

namespace App\Http\Controllers\API\Akun;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\Konsumen\ValidatorKonsumen;
use App\Http\Resources\Akun\Konsumen\GetKonsumenResource;
use App\Models\Akun\Konsumen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KonsumenController extends Controller
{
    public function index()
    {
        return DB::transaction(function () {
            $konsumen = Konsumen::orderBy("created_at", "DESC")->paginate(10);
            
            return GetKonsumenResource::collection($konsumen);
        });
    }
    
    public function store(ValidatorKonsumen $request)
    {
        return DB::transaction(function () use ($request) {
            
            $user = User::create([
                "nama" => $request->nama,
                "password" => bcrypt($request->password),
                "email" => $request->email,
                "nomor_hp" => $request->nomor_hp,
                "alamat" => "Indonesia",
                "id_role" => "RO-2003064",
                "status" => 1
            ]);
            
            $konsumen = Konsumen::create([
                "id_konsumen" => "KSN-" . date("YmdHis"),
                "user_id" => $user->id,
                "nik" => $request->nik
            ]);
            
            $curl = curl_init();
            
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => "$request->nomor_hp|$request->nama",
                    'message' => 'Selamat Datang *' . $request->nama . '*, di *SmartHealth*

Mohammad ',
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: KzQ7wps3mtkvyaWxKSBs'
                ),
            ));
            
            $response = curl_exec($curl);
            
            curl_close($curl);
            
            return response()->json([
                "pesan" => "Data Konsumen Berhasil di Tambahkan", 
                "user" => $user["id"],
                "konsumen_id" => $konsumen["id_konsumen"]
            ]);
        });
    }
    
    public function edit($id_konsumen)
    {
        return DB::transaction(function () use ($id_konsumen) {
            $konsumen = Konsumen::where("id_konsumen", $id_konsumen)->first();
            
            return new GetKonsumenResource($konsumen);
        });
    }
    
    public function update(Request $request, $id_konsumen)
    {
        return DB::transaction(function () use ($id_konsumen, $request) {
            
            $konsumen = Konsumen::where("id_konsumen", $id_konsumen)->first();
            
            User::where("id", $konsumen->user_id)->update([
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
            
            Konsumen::where("id_konsumen", $id_konsumen)->update([
                "nik" => $request->nik
            ]);
            
            return response()->json(["pesan" => "Data Konsumen Berhasil di Simpan"]);
        });
    }
    
    public function destroy($id_konsumen)
    {
        return DB::transaction(function () use ($id_konsumen) {
            
            Konsumen::where("id_konsumen", $id_konsumen)->delete();
            
            return response()->json(["pesan" => "Data Konsumen Berhasil di Hapus"]);
        });
    }
}
