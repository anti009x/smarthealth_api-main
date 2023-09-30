<?php

namespace Database\Seeders\Akun;

use App\Models\Akun\Konsumen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KonsumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Konsumen::create([
            "id_konsumen" => "KSN-2005033",
            "user_id" => 7,
            "nik" => "322222151515151"
        ]);
    }
}
