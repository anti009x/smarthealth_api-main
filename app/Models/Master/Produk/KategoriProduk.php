<?php

namespace App\Models\Master\Produk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriProduk extends Model
{
    use HasFactory;

    protected $table = "kategori_produk";

    protected $guarded = [''];

    public $primaryKey = "id_kategori_produk";

    protected $keyType = "string";

    public $incrementing = false;
}
