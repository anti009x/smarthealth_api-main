<?php

namespace Database\Seeders\Master\RumahSakit;

use App\Models\Master\RumahSakit\FasilitasRumahSakit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FasilitasRumahSakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FasilitasRumahSakit::create([
            "id_fasilitas" => "FSL-001",
            "id_rumah_sakit" => "RS-123456789",
            "nama_fasilitas" => "Kamar Mandi Dalam"
        ]);

        FasilitasRumahSakit::create([
            "id_fasilitas" => "FSL-002",
            "id_rumah_sakit" => "RS-123456789",
            "nama_fasilitas" => "Tempat Duduk"
        ]);

        FasilitasRumahSakit::create([
            "id_fasilitas" => "FSL-003",
            "id_rumah_sakit" => "RS-123456789",
            "nama_fasilitas" => "Kantin"
        ]);

        FasilitasRumahSakit::create([
            "id_fasilitas" => "FSL-004",
            "id_rumah_sakit" => "RS-123456789",
            "nama_fasilitas" => "Masjid"
        ]);

        FasilitasRumahSakit::create([
            "id_fasilitas" => "FSL-005",
            "id_rumah_sakit" => "RS-123456789",
            "nama_fasilitas" => "IGD"
        ]);

        FasilitasRumahSakit::create([
            "id_fasilitas" => "FSL-006",
            "id_rumah_sakit" => "RS-123456789",
            "nama_fasilitas" => "Laboratorium"
        ]);

        FasilitasRumahSakit::create([
            "id_fasilitas" => "FSL-007",
            "id_rumah_sakit" => "RS-123456789",
            "nama_fasilitas" => "Tempat Parkir Dalam"
        ]);

        FasilitasRumahSakit::create([
            "id_fasilitas" => "FSL-008",
            "id_rumah_sakit" => "RS-123456789",
            "nama_fasilitas" => "Private Room"
        ]);

        FasilitasRumahSakit::create([
            "id_fasilitas" => "FSL-009",
            "id_rumah_sakit" => "RS-123456790",
            "nama_fasilitas" => "Kamar Mandi Dalam"
        ]);

        FasilitasRumahSakit::create([
            "id_fasilitas" => "FSL-010",
            "id_rumah_sakit" => "RS-123456790",
            "nama_fasilitas" => "Tempat Duduk"
        ]);

        FasilitasRumahSakit::create([
            "id_fasilitas" => "FSL-011",
            "id_rumah_sakit" => "RS-123456790",
            "nama_fasilitas" => "Kantin"
        ]);

        FasilitasRumahSakit::create([
            "id_fasilitas" => "FSL-012",
            "id_rumah_sakit" => "RS-123456790",
            "nama_fasilitas" => "Masjid"
        ]);

        FasilitasRumahSakit::create([
            "id_fasilitas" => "FSL-013",
            "id_rumah_sakit" => "RS-123456790",
            "nama_fasilitas" => "IGD"
        ]);

        FasilitasRumahSakit::create([
            "id_fasilitas" => "FSL-014",
            "id_rumah_sakit" => "RS-123456790",
            "nama_fasilitas" => "Laboratorium"
        ]);

        FasilitasRumahSakit::create([
            "id_fasilitas" => "FSL-015",
            "id_rumah_sakit" => "RS-123456790",
            "nama_fasilitas" => "Tempat Parkir Dalam"
        ]);

        FasilitasRumahSakit::create([
            "id_fasilitas" => "FSL-016",
            "id_rumah_sakit" => "RS-123456790",
            "nama_fasilitas" => "Private Room"
        ]);
    }
}
