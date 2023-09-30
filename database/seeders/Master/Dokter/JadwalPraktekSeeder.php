<?php

namespace Database\Seeders\Master\Dokter;

use App\Models\Ahli\JadwalPraktek;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalPraktekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JadwalPraktek::create([
            "id_jadwal_praktek" => "JDWL-P-2003061",
            "id_detail_praktek" => "JDWL-P-2001",
            "hari" => "Tuesday",
            "tanggal" => "2023-06-10",
            "mulai_jam" => "07:00",
            "selesai_jam" => "09:00"
        ]);
    }
}
