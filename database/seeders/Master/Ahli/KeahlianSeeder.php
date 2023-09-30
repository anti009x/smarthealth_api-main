<?php

namespace Database\Seeders\Master\Ahli;

use App\Models\Ahli\Keahlian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeahlianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Keahlian::create([
            "id_keahlian" => "KHLI-2001",
            "nama_keahlian" => "Kecemasan",
            "id_spesialis_penyakit" => "SPS-001",
        ]);

        Keahlian::create([
            "id_keahlian" => "KHLI-2002",
            "nama_keahlian" => "Stress",
            "id_spesialis_penyakit" => "SPS-001",
        ]);

        Keahlian::create([
            "id_keahlian" => "KHLI-2003",
            "nama_keahlian" => "Depresi",
            "id_spesialis_penyakit" => "SPS-001",
        ]);

        Keahlian::create([
            "id_keahlian" => "KHLI-2004",
            "nama_keahlian" => "Keluarga",
            "id_spesialis_penyakit" => "SPS-002",
        ]);
        
        Keahlian::create([
            "id_keahlian" => "KHLI-2005",
            "nama_keahlian" => "Trauma",
            "id_spesialis_penyakit" => "SPS-002",
        ]);

        Keahlian::create([
            "id_keahlian" => "KHLI-2006",
            "nama_keahlian" => "Mood",
            "id_spesialis_penyakit" => "SPS-002",
        ]);

        Keahlian::create([
            "id_keahlian" => "KHLI-2007",
            "nama_keahlian" => "Kecanduan",
            "id_spesialis_penyakit" => "SPS-002",
        ]);

        Keahlian::create([
            "id_keahlian" => "KHLI-2008",
            "nama_keahlian" => "Seksual",
            "id_spesialis_penyakit" => "SPS-003",
        ]);

        Keahlian::create([
            "id_keahlian" => "KHLI-2009",
            "nama_keahlian" => "Kepribadian",
            "id_spesialis_penyakit" => "SPS-004",
        ]);

        Keahlian::create([
            "id_keahlian" => "KHLI-2010",
            "nama_keahlian" => "Pengembangan Diri",
            "id_spesialis_penyakit" => "SPS-004",
        ]);
    }
}
