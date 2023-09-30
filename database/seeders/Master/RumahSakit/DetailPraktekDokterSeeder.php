<?php

namespace Database\Seeders\Master\RumahSakit;

use App\Models\Ahli\DetailPraktek;
use App\Models\Master\RumahSakit\DetailPraktekDokter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailPraktekDokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DetailPraktek::create([
            "id_detail_praktek" => "JDWL-P-2001",
            "ahli_id" => 2,
            "id_rumah_sakit" => "RS-123456789",
            "biaya_praktek" => "20000"
        ]);

        DetailPraktek::create([
            "id_detail_praktek" => "JDWL-P-2002",
            "ahli_id" => 14,
            "id_rumah_sakit" => "RS-123456790",
            "biaya_praktek" => "30000"
        ]);
    }
}
