<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeranjangDetail extends Model
{
    use HasFactory;

    protected $table = "keranjang_detail";

    protected $guarded = [''];

    public $primaryKey = "id_keranjang_detail";

    protected $keyType = "string";

    public $incrementing = false;

    public function keranjang()
    {
        return $this->belongsTo("App\Models\Transaksi\Keranjang", "keranjang_id", "id_keranjang");
    }

    public function produk()
    {
        return $this->belongsTo("App\Models\Apotek\Produk\ProdukApotek", "produk_id", "id_produk");
    }
}
