<?php

namespace Database\Seeders\Master\Penyakit;

use App\Models\Master\Penyakit\SpesialisPenyakit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpesialisPenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SpesialisPenyakit::create([
            "id_spesialis_penyakit" => "SPS-001",
            "nama_spesialis" => "Dentist",
            "slug_spesialis" => "dentist",
            "icon" => "fa-solid fa-tooth"
        ]);

        SpesialisPenyakit::create([
            "id_spesialis_penyakit" => "SPS-002",
            "nama_spesialis" => "THT",
            "slug_spesialis" => "tht",
            "icon" => "fa-solid fa-ear-listen"
        ]);

        SpesialisPenyakit::create([
            "id_spesialis_penyakit" => "SPS-003",
            "nama_spesialis" => "Orthopedi",
            "slug_spesialis" => "orthopedi",
            "icon" => "fa-solid fa-bone"
        ]);

        SpesialisPenyakit::create([
            "id_spesialis_penyakit" => "SPS-004",
            "nama_spesialis" => "Jantung",
            "slug_spesialis" => "jantung",
            "icon" => "fa-solid fa-heart-pulse"
        ]);

        SpesialisPenyakit::create([
            "id_spesialis_penyakit" => "SPS-005",
            "nama_spesialis" => "Penyakit-dalam",
            "slug_spesialis" => "penyakit-dalam",
            "icon" => "fa-solid fa-hand-holding-heart"
        ]);

        SpesialisPenyakit::create([
            "id_spesialis_penyakit" => "SPS-006",
            "nama_spesialis" => "Kulit",
            "slug_spesialis" => "kulit",
            "icon" => "fa-solid fa-hand-dots"
        ]);

        SpesialisPenyakit::create([
            "id_spesialis_penyakit" => "SPS-007",
            "nama_spesialis" => "Mata",
            "slug_spesialis" => "mata",
            "icon" => "fa-solid fa-eye"
        ]);

        SpesialisPenyakit::create([
            "id_spesialis_penyakit" => "SPS-008",
            "nama_spesialis" => "Neurologist",
            "slug_spesialis" => "neurologist",
            "icon" => "fa-solid fa-lungs-virus"
        ]);

        SpesialisPenyakit::create([
            "id_spesialis_penyakit" => "SPS-009",
            "nama_spesialis" => "Internist",
            "slug_spesialis" => "internist",
            "icon" => "fa-solid fa-person-breastfeeding"
        ]);

        SpesialisPenyakit::create([
            "id_spesialis_penyakit" => "SPS-010",
            "nama_spesialis" => "Obstetrics",
            "slug_spesialis" => "obstetics",
            "icon" => "fa-solid fa-head-side-mask"
        ]);
    }
}
