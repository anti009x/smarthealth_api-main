<?php

namespace App\Models\Apotek\Produk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukKategori extends Model
{
    use HasFactory;

    protected $table = "produk_kategori";

    protected $guarded = [''];

    public $primaryKey = "id_produk_kategori";

    protected $keyType = "string";

    public $incrementing = false;

    public function getProduk()
    {
        return $this->belongsTo("App\Models\Apotek\Produk\ProdukApotek", "kode_produk", "kode_produk");
    }

    public function getKategori()
    {
        return $this->belongsTo("App\Models\Master\Produk\KategoriProduk", "id_kategori_produk", "id_kategori_produk");
    }
}
