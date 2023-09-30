<?php

namespace App\Http\Controllers\API\Tes;

use App\Http\Controllers\Controller;
use App\Http\Resources\Master\CekResi\GetResiResources;
use App\Models\Master\CekResi\CekResi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CekResiController extends Controller
{
    public function index(){
        return DB::transaction(function(){
            $cekresi = CekResi::get();

            return GetResiResources::collection($cekresi);
        });
    }
}
