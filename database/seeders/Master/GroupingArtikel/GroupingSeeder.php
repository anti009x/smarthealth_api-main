<?php

namespace Database\Seeders\Master\GroupingArtikel;

use App\Models\Artikel\GroupingArtikel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GroupingArtikel::create([
            "id_grouping_artikel" => "GRO-A-123456",
            "id_artikel" => "ART-12345678",
            "id_kategori_artikel" => "KT-A-2003061"
        ]);

        GroupingArtikel::create([
            "id_grouping_artikel" => "GRO-A-123457",
            "id_artikel" => "ART-12345679",
            "id_kategori_artikel" => "KT-A-2003064"
        ]);

        GroupingArtikel::create([
            "id_grouping_artikel" => "GRO-A-123458",
            "id_artikel" => "ART-12345678",
            "id_kategori_artikel" => "KT-A-2003064"
        ]);
    }
}
