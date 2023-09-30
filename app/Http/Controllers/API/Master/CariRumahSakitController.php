<?php

namespace App\Http\Controllers\API\Master;

use App\Http\Controllers\Controller;
use App\Models\Akun\RumahSakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CariRumahSakitController extends Controller
{
    public function index(Request $request)
    {
        return DB::transaction(function() use($request) {
            $search = $request->search;
            
            $rumah_sakit = RumahSakit::where(function($query) use($search) {
                $query->where("nama_rs", "LIKE", '%' . $search . '%')
                        ->orWhere("alamat_rs", "LIKE", "%" . $search . '%');
            })->get();

            return response()->json(["data" => $rumah_sakit]);
        });
    }
}
