<?php

namespace Database\Seeders\Akun;

use App\Models\Akun\OwnerRumahSakit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OwnerRumahSakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OwnerRumahSakit::create([
            "id_owner_rumah_sakit" => "OWN-RS-2003061",
            "no_ktp" => "23029320392032",
            "user_id" => 11
        ]);

        OwnerRumahSakit::create([
            "id_owner_rumah_sakit" => "OWN-RS-2003062",
            "no_ktp" => "23029320392032",
            "user_id" => 12
        ]);
    }
}
