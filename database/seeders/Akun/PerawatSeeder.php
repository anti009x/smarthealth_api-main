<?php

namespace Database\Seeders\Akun;

use App\Models\Akun\Perawat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerawatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Perawat::create([
            "id_perawat" => "PWT-2005033",
            "nomor_strp" => "829328392",
            "user_id" => 14,
        ]);

        Perawat::create([
            "id_perawat" => "PWT-2005034",
            "nomor_strp" => "829328393",
            "user_id" => 15,
        ]);

        Perawat::create([
            "id_perawat" => "PWT-2005035",
            "nomor_strp" => "829328394",
            "user_id" => 18,
        ]);

        Perawat::create([
            "id_perawat" => "PWT-2005036",
            "nomor_strp" => "829328395",
            "user_id" => 19,
        ]);
    }
}
