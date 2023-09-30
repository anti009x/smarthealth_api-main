<?php

namespace Database\Seeders\Master\CekResi;

use App\Models\Master\CekResi\CekResi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CekResiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CekResi::create([
            "id_resi" => "R-1",
            "nama_jasa_pengiriman" => "JNE",
            "kode_ekspedisi" => "jne"
        ]);
        CekResi::create([
            "id_resi" => "R-2",
            "nama_jasa_pengiriman" => "JNT",
            "kode_ekspedisi" => "jnt"
        ]);
        CekResi::create([
            "id_resi" => "R-3",
            "nama_jasa_pengiriman" => "SiCepat",
            "kode_ekspedisi" => "sicepat"
        ]);
        CekResi::create([
            "id_resi" => "R-4",
            "nama_jasa_pengiriman" => "AnterAja",
            "kode_ekspedisi" => "anteraja"
        ]);
        CekResi::create([
            "id_resi" => "R-5",
            "nama_jasa_pengiriman" => "Shopee Express",
            "kode_ekspedisi" => "spx"
        ]);
        CekResi::create([
            "id_resi" => "R-6",
            "nama_jasa_pengiriman" => "ID Express",
            "kode_ekspedisi" => "ide"
        ]);
    }
}
