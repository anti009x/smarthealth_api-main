<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Akun\Dokter;
use App\Models\Akun\Konsumen;
use App\Models\Akun\OwnerApotek;
use App\Models\Akun\Perawat;
use App\Models\Akun\RumahSakit;
use App\Models\Master\Dokter\JadwalAntrian;
use App\Models\TestingPayment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function pembayaran()
    {
        $data["pembayaran"] = TestingPayment::get();

        return view("pembayaran", $data);
    }

    public function create_api()
    {
        $user = User::find(1);

        $token = $user->createToken("ApiToken")->plainTextToken;

        $response = [
            "success" => true,
            "user" => $user,
            "token" => $token
        ];

        return response($response, 201);
    }

    public function dashboard()
    {
        $data = [
            "dokter" => Dokter::count(),
            "perawat" => Perawat::count(),
            "konsumen" => Konsumen::count(),
            "apotek" => OwnerApotek::count(),
            "rumah_sakit"=> RumahSakit::count()
        ];

        return response()->json(["jumlah_data" => [$data]]);
    }

    public function is_active()
    {
        return DB::transaction(function() {
            Dokter::where("user_id", Auth::user()->id)->update([
                "is_online" => 0
            ]);

            return response()->json(["pesan" => "Data Berhasil di Simpan"]);
        });
    }

    public function qr($code)
    {
        return DB::transaction(function() use ($code) {
            $jadwal = JadwalAntrian::where("id_jadwal_antrian", $code)->first();

            return response()->json($jadwal);
        });
    }
}
