<?php

namespace Database\Seeders\Master\Kategori;

use App\Models\Artikel\KategoriArtikel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriArtikelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KategoriArtikel::create([
            "id_kategori_artikel" => "KT-A-2003061",
            "nama_kategori" => "Semua"
        ]);

        KategoriArtikel::create([
            "id_kategori_artikel" => "KT-A-2003064",
            "nama_kategori" => "Kesehatan Badan"
        ]);

        KategoriArtikel::create([
            "id_kategori_artikel" => "KT-A-2003065",
            "nama_kategori" => "Kesehatan Mental"
        ]);

        KategoriArtikel::create([
            "id_kategori_artikel" => "KT-A-2003066",
            "nama_kategori" => "Hidup Sehat"
        ]);
    }
}
