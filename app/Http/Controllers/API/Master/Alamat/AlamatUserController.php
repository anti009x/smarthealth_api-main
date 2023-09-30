<?php

namespace App\Http\Controllers\API\Master\Alamat;

use App\Http\Controllers\Controller;
use App\Http\Resources\Master\AlamatUserResource;
use App\Models\Master\Alamatuser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AlamatUserController extends Controller
{
    public function index()
    {
        return DB::transaction(function() {
            $data = Alamatuser::where("user_id", Auth::user()->id)->orderBy("created_at", "DESC")->get();

            return AlamatUserResource::collection($data);
        });
    }

    public function store(Request $request)
    {
        return DB::transaction(function() use ($request) {
            Alamatuser::create([
                "id_alamat_user" => "AL-M-" . date("YmdHis"),
                "user_id" => Auth::user()->id,
                "simpan_sebagai" => $request->simpan_sebagai,
                "lokasi" => $request->lokasi,
                "detail" => $request->detail
            ]);
            
            return response()->json(["pesan" => "Data Berhasil di Tambahkan"]);
        });
    }

    public function edit($id_alamat)
    {
        return DB::transaction(function() use ($id_alamat) {
            $alamat = Alamatuser::where("id_alamat_user", $id_alamat)->first();

            return new AlamatUserResource($alamat);
        });
    }

    public function update(Request $request, $id_alamat)
    {
        return DB::transaction(function () use ($request, $id_alamat) {
            Alamatuser::where("id_alamat_user", $id_alamat)->update([
                "simpan_sebagai" => $request->simpan_sebagai,
                "lokasi" => $request->lokasi,
                "detail" => $request->detail
            ]);

            return response()->json(["pesan" => "Data Berhasil di Simpan"]);
        });
    }

    public function destroy($id_alamat)
    {
        return DB::transaction(function() use ($id_alamat) {
            Alamatuser::where("id_alamat_user", $id_alamat)->delete();

            return response()->json(["pesan" => "Data Berhasil di Hapus"]);
        });
    }
}
