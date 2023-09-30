<?php

namespace Database\Seeders\Akun;

use App\Models\Akun\RumahSakit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RumahSakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RumahSakit::create([
            "id_rumah_sakit" => "RS-123456789",
            "id_owner_rumah_sakit" => "OWN-RS-2003061",
            "nama_rs" => "RS. Plumbon",
            "slug_rs" => "rs-plumbon",
            "deskripsi_rs" => "lorem ipsum dolor sit amet",
            "kategori_rs" => 1,
            "alamat_rs" => "Indonesia",
            "latitude" => "-6.7016333",
            "longitude" => "108.4789808"
        ]);

        RumahSakit::create([
            "id_rumah_sakit" => "RS-123456790",
            "id_owner_rumah_sakit" => "OWN-RS-2003061",
            "nama_rs" => "RS. Sumber Kasih",
            "slug_rs" => "rs-sumber-kasih",
            "deskripsi_rs" => "lorem ipsum dolor sit amet",
            "kategori_rs" => 1,
            "alamat_rs" => "Indonesia",
            "latitude" => "-6.7082991",
            "longitude" => "108.5578181"
        ]);

        RumahSakit::create([
            "id_rumah_sakit" => "RS-123456791",
            "id_owner_rumah_sakit" => "OWN-RS-2003062",
            "nama_rs" => "Rumah Sakit Mitra Plumbon Indramayu",
            "slug_rs" => "rumah-sakit-mitra-plumbon-indramayu",
            "deskripsi_rs" => "lorem ipsum dolor sit amet",
            "kategori_rs" => 1,
            "alamat_rs" => "Indonesia",
            "latitude" => "-6.4583944367163815",
            "longitude" => "108.28790140932364"
        ]);

        RumahSakit::create([
            "id_rumah_sakit" => "RS-123456792",
            "id_owner_rumah_sakit" => "OWN-RS-2003062",
            "nama_rs" => "RS Medissina Lohbener",
            "slug_rs" => "rs-medissina-lohbener",
            "deskripsi_rs" => "lorem ipsum dolor sit amet",
            "kategori_rs" => 1,
            "alamat_rs" => "Jl. Nasional 7, Lohbener, Kec. Lohbener, Kabupaten Indramayu, Jawa Barat 45252",
            "latitude" => "-6.40216",
            "longitude" => "108.27085"
        ]);
    }
}
