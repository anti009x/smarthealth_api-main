<?php

namespace Database\Seeders\Master\Dokter;

use App\Models\Ahli\BiayaPraktek;
use App\Models\Master\Dokter\BiayaDokter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BiayaDokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BiayaPraktek::create([
            "id_biaya_praktek" => "BIA-P-001",
            "ahli_id" => 2,
            "biaya" => 20000
        ]);

        BiayaPraktek::create([
            "id_biaya_praktek" => "BIA-P-002",
            "ahli_id" => 6,
            "biaya" => 30000
        ]);

        BiayaPraktek::create([
            "id_biaya_praktek" => "BIA-P-003",
            "ahli_id" => 10,
            "biaya" => 40000
        ]);

        BiayaPraktek::create([
            "id_biaya_praktek" => "BIA-P-004",
            "ahli_id" => 16,
            "biaya" => 40000
        ]);

        BiayaPraktek::create([
            "id_biaya_praktek" => "BIA-P-005",
            "ahli_id" => 17,
            "biaya" => 40000
        ]);
    }
}
