<?php

namespace Database\Seeders\Master\RumahSakit;

use App\Models\Ahli\PraktekAhli;
use App\Models\Master\RumahSakit\PraktekDokter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PraktekDokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PraktekAhli::create([
            "id_praktek" => "PRTK-001",
            "id_dokter" => "DKTR-09022004",
            "id_keahlian" => "KHLI-2001",
            "id_spesialis" => "SPS-001",
            "id_rumah_sakit" => "RS-123456789"
        ]);

        PraktekAhli::create([
            "id_praktek" => "PRTK-002",
            "id_dokter" => "DKTR-09022003",
            "id_keahlian" => "KHLI-2002",
            "id_spesialis" => "SPS-002",
            "id_rumah_sakit" => "RS-123456789"
        ]);
    }
}
