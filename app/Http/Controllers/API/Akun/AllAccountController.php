<?php

namespace App\Http\Controllers\API\Akun;

use App\Http\Controllers\Controller;
use App\Http\Resources\Akun\AllAccount\GetAllAccountResource;
use App\Http\Resources\Akun\AllAccount\GetDataPraktekDokterResource;
use App\Http\Resources\Akun\AllAccount\GetDataRegisterResource;
use App\Models\Ahli\DetailPraktek;
use App\Models\Ahli\PraktekAhli;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AllAccountController extends Controller
{
    public function index()
    {
        return DB::transaction(function () {
            $all_account = User::orderBy("created_at", "DESC")->with("getRole:id_role,nama_role")->get();

            return GetAllAccountResource::collection($all_account);
        });
    }

    public function data_register(Request $request)
    {
        return DB::transaction(function() use ($request) {
            $data = User::where("status", "0")->orderBy("created_at", "ASC")->paginate($request->per_page);

            return GetDataRegisterResource::collection($data);
        });
    }

    public function data_praktek_dokter()
    {
        return DB::transaction(function() {
            $data = PraktekAhli::where("id_keahlian", NULL)->where("id_spesialis", NULL)->get();

            return GetDataPraktekDokterResource::collection($data);
        });
    }
    
    public function update(Request $request, $id_praktek_ahli)
    {
        try {
            $messages = [
                "required" => "Kolom :attribute Harus Diisi"
            ];
            
            $this->validate($request, [
                "biaya_praktek" => "required",
                "id_keahlian" => "required",
                "id_spesialis" => "required"
            ], $messages);

            $user = PraktekAhli::where("id_praktek_ahli", $id_praktek_ahli)->first();

            PraktekAhli::where("id_praktek_ahli", $id_praktek_ahli)->update([
                "id_keahlian" => $request->id_keahlian,
                "id_spesialis" => $request->id_spesialis
            ]);

            DetailPraktek::where("ahli_id", $user["ahli_id"])->update([
                "biaya_praktek" => $request->biaya_praktek
            ]);

            User::where("id", $user["ahli_id"])->update([
                "status" => 1
            ]);
            
        } catch (ValidationException $e) {
            return response()->json(["errors" => $e->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json(["pesan" => "Data Akun Dokter Berhasil di Aktifkan"]);
    }
}
