<?php

namespace Database\Seeders\Apotek\Produk;

use App\Models\Apotek\Produk\ProdukKategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProdukKategori::create([
            "id_produk_kategori" => "PRO-K-001",
            "kode_produk" => "PRO-2003061",
            "id_kategori_produk" => "KT-P-2001"
        ]);

        ProdukKategori::create([
            "id_produk_kategori" => "PRO-K-002",
            "kode_produk" => "PRO-2003061",
            "id_kategori_produk" => "KT-P-2002"
        ]);

        ProdukKategori::create([
            "id_produk_kategori" => "PRO-K-003",
            "kode_produk" => "PRO-2003061",
            "id_kategori_produk" => "KT-P-2003"
        ]);

        ProdukKategori::create([
            "id_produk_kategori" => "PRO-K-004",
            "kode_produk" => "PRO-2003062",
            "id_kategori_produk" => "KT-P-2001"
        ]);

        ProdukKategori::create([
            "id_produk_kategori" => "PRO-K-005",
            "kode_produk" => "PRO-2003062",
            "id_kategori_produk" => "KT-P-2002"
        ]);
    }
}
