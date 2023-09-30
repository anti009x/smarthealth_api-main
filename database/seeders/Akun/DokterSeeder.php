<?php

namespace Database\Seeders\Akun;

use App\Models\Akun\Dokter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dokter::create([
            "id_dokter" => "DKTR-09022002",
            "user_id" => 2,
            "nomor_str" => "3212121211212121",
            "kelas" => "1"
        ]);

        Dokter::create([
            "id_dokter" => "DKTR-09022003",
            "user_id" => 6,
            "nomor_str" => "3212121211212121",
            "kelas" => "0"
        ]);

        Dokter::create([
            "id_dokter" => "DKTR-09022004",
            "user_id" => 10,
            "nomor_str" => "3212121211212121",
            "kelas" => "1"
        ]);

        Dokter::create([
            "id_dokter" => "DKTR-09022005",
            "user_id" => 16,
            "nomor_str" => "29302932029",
            "kelas" => "0"
        ]);

        Dokter::create([
            "id_dokter" => "DKTR-09022006",
            "user_id" => 17,
            "nomor_str" => "29302932030",
            "kelas" => "0"
        ]);
    }
}
