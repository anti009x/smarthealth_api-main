<?php

namespace Database\Seeders\Apotek;

use App\Models\Apotek\Pengaturan\ProfilApotek;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilApotekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProfilApotek::create([
            "id_profil_apotek" => "PR-A-12345678910",
            "nama_apotek" => "Apotek Kimia Farma Arjawinangun",
            "slug_apotek" => "apotek-kimia-farma-arjawinangun",
            "deskripsi_apotek" => "Bandung",
            "alamat_apotek" => "Jakarta Raya",
            "nomor_hp_apotek" => "2389283923",
            "status" => 1,
            "id_user" => 8,
            "user_penanggung_jawab_id" => 8,
            "latitude" => "-6.6539487",
            "longitude" => "108.4072596"
        ]);

        ProfilApotek::create([
            "id_profil_apotek" => "PR-A-12345678911",
            "nama_apotek" => "Apotek Kimia Farma Klayan",
            "slug_apotek" => "apotek-kimia-farma-klayan",
            "deskripsi_apotek" => "Bandung Jakarta",
            "alamat_apotek" => "Jakarta Raya",
            "nomor_hp_apotek" => "2389283924",
            "status" => 0,
            "id_user" => 8,
            "user_penanggung_jawab_id" => 8,
            "latitude" => "-6.6868722",
            "longitude" => "108.5462849"
        ]);
    }
}
