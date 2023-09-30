<?php

namespace Database\Seeders\Master\RumahSakit;

use App\Models\Master\RumahSakit\SpesialisRumahSakit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpesialisRumahSakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SpesialisRumahSakit::create([
            "id_spesialis" => "SPS-RS-001",
            "id_rumah_sakit" => "RS-123456789",
            "id_penyakit" => "SPS-001"
        ]);

        SpesialisRumahSakit::create([
            "id_spesialis" => "SPS-RS-002",
            "id_rumah_sakit" => "RS-123456789",
            "id_penyakit" => "SPS-002"
        ]);

        SpesialisRumahSakit::create([
            "id_spesialis" => "SPS-RS-003",
            "id_rumah_sakit" => "RS-123456789",
            "id_penyakit" => "SPS-003"
        ]);

        SpesialisRumahSakit::create([
            "id_spesialis" => "SPS-RS-004",
            "id_rumah_sakit" => "RS-123456789",
            "id_penyakit" => "SPS-004"
        ]);

        SpesialisRumahSakit::create([
            "id_spesialis" => "SPS-RS-005",
            "id_rumah_sakit" => "RS-123456789",
            "id_penyakit" => "SPS-005"
        ]);

        SpesialisRumahSakit::create([
            "id_spesialis" => "SPS-RS-006",
            "id_rumah_sakit" => "RS-123456789",
            "id_penyakit" => "SPS-006"
        ]);

        SpesialisRumahSakit::create([
            "id_spesialis" => "SPS-RS-007",
            "id_rumah_sakit" => "RS-123456789",
            "id_penyakit" => "SPS-007"
        ]);

        SpesialisRumahSakit::create([
            "id_spesialis" => "SPS-RS-008",
            "id_rumah_sakit" => "RS-123456789",
            "id_penyakit" => "SPS-008"
        ]);

        SpesialisRumahSakit::create([
            "id_spesialis" => "SPS-RS-009",
            "id_rumah_sakit" => "RS-123456789",
            "id_penyakit" => "SPS-009"
        ]);

        SpesialisRumahSakit::create([
            "id_spesialis" => "SPS-RS-010",
            "id_rumah_sakit" => "RS-123456789",
            "id_penyakit" => "SPS-010"
        ]);

        SpesialisRumahSakit::create([
            "id_spesialis" => "SPS-RS-011",
            "id_rumah_sakit" => "RS-123456790",
            "id_penyakit" => "SPS-001"
        ]);

        SpesialisRumahSakit::create([
            "id_spesialis" => "SPS-RS-012",
            "id_rumah_sakit" => "RS-123456790",
            "id_penyakit" => "SPS-002"
        ]);

        SpesialisRumahSakit::create([
            "id_spesialis" => "SPS-RS-013",
            "id_rumah_sakit" => "RS-123456790",
            "id_penyakit" => "SPS-003"
        ]);

        SpesialisRumahSakit::create([
            "id_spesialis" => "SPS-RS-014",
            "id_rumah_sakit" => "RS-123456790",
            "id_penyakit" => "SPS-004"
        ]);

        SpesialisRumahSakit::create([
            "id_spesialis" => "SPS-RS-015",
            "id_rumah_sakit" => "RS-123456790",
            "id_penyakit" => "SPS-005"
        ]);

        SpesialisRumahSakit::create([
            "id_spesialis" => "SPS-RS-016",
            "id_rumah_sakit" => "RS-123456790",
            "id_penyakit" => "SPS-006"
        ]);

        SpesialisRumahSakit::create([
            "id_spesialis" => "SPS-RS-017",
            "id_rumah_sakit" => "RS-123456790",
            "id_penyakit" => "SPS-007"
        ]);

        SpesialisRumahSakit::create([
            "id_spesialis" => "SPS-RS-018",
            "id_rumah_sakit" => "RS-123456790",
            "id_penyakit" => "SPS-008"
        ]);
    }
}
