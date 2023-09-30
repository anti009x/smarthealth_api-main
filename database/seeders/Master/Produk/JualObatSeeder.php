<?php

namespace Database\Seeders\Master\Produk;

use App\Models\Master\Produk\JualObat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JualObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JualObat::create([
            "id_jual_obat" => "JL-A-2003061",
            "jenis_jual" => "Per Botol"
        ]);

        JualObat::create([
            "id_jual_obat" => "JL-A-2003062",
            "jenis_jual" => "Per Unit"
        ]);

        JualObat::create([
            "id_jual_obat" => "JL-A-2003063",
            "jenis_jual" => "Per Tablet"
        ]);

        JualObat::create([
            "id_jual_obat" => "JL-A-2003064",
            "jenis_jual" => "Per 10 Sachet"
        ]);

        JualObat::create([
            "id_jual_obat" => "JL-A-2003065",
            "jenis_jual" => "Per 5 Strip"
        ]);

        JualObat::create([
            "id_jual_obat" => "JL-A-2003066",
            "jenis_jual" => "Per 2 Strip"
        ]);

        JualObat::create([
            "id_jual_obat" => "JL-A-2003067",
            "jenis_jual" => "Per 10 Strip"
        ]);
    }
}
