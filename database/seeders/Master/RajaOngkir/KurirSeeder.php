<?php

namespace Database\Seeders\Master\RajaOngkir;

use App\Models\Master\RajaOngkir\Kurir;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KurirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["code" => "jne", "title" => "JNE"],
            ["code" => "pos", "title" => "POS"],
            ["code" => "tiki", "title" => "TIKI"]
        ];

        Kurir::insert($data);
    }
}
