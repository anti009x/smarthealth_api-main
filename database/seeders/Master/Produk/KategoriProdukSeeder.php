<?php

namespace Database\Seeders\Master\Produk;

use App\Models\Master\Produk\KategoriProduk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KategoriProduk::create([
            "id_kategori_produk" => "KT-P-2001",
            "nama_kategori_produk" => "Suplemen",
            "slug_kategori_produk" => "suplemen"
        ]);

        KategoriProduk::create([
            "id_kategori_produk" => "KT-P-2002",
            "nama_kategori_produk" => "Bodrex",
            "slug_kategori_produk" => "bodrex"
        ]);

        KategoriProduk::create([
            "id_kategori_produk" => "KT-P-2003",
            "nama_kategori_produk" => "Vitamin",
            "slug_kategori_produk" => "vitamin"
        ]);

        KategoriProduk::create([
            "id_kategori_produk" => "KT-P-2004",
            "nama_kategori_produk" => "Bayam",
            "slug_kategori_produk" => "bayam"
        ]);

        KategoriProduk::create([
            "id_kategori_produk" => "KT-P-2005",
            "nama_kategori_produk" => "Sayuran",
            "slug_kategori_produk" => "sayuran"
        ]);

        KategoriProduk::create([
            "id_kategori_produk" => "KT-P-2006",
            "nama_kategori_produk" => "Kesehatan",
            "slug_kategori_produk" => "kesehatan"
        ]);

        KategoriProduk::create([
            "id_kategori_produk" => "KT-P-2007",
            "nama_kategori_produk" => "Bahan Bakar",
            "slug_kategori_produk" => "bahan-bakar"
        ]);

        KategoriProduk::create([
            "id_kategori_produk" => "KT-P-2008",
            "nama_kategori_produk" => "Kesehatan Anak",
            "slug_kategori_produk" => "kesehatan-anak"
        ]);
    }
}
