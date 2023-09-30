<?php

namespace App\Http\Controllers\Master\Ahli;

use App\Http\Controllers\Controller;
use App\Models\Master\Ahli\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        return DB::transaction(function() use ($request) {
            Rating::create([
                "id_rating" => "RATE-" . date("YmdHis"),
                "user_id" => Auth::user()->id,
                "ahli_id" => $request["ahli_id"],
                "star" => $request["star"]
            ]);

            return response()->json(["pesan" => "Data Berhasil di Tambahkan"]);
        });
    }
}
