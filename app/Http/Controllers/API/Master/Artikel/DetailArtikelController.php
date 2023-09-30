<?php

namespace App\Http\Controllers\API\Master\Artikel;

use App\Http\Controllers\Controller;
use App\Http\Resources\Artikel\Master\DataArtikel\GetArtikelResource;
use App\Models\Artikel\DataArtikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailArtikelController extends Controller
{
    public function index($slug)
    {
        return DB::transaction(function () use ($slug) {
            $artikel = DataArtikel::where("slug_artikel", $slug)->with("getUser:id,nama,id_role")->first();

            return new GetArtikelResource($artikel);
        });
    }
}
