<?php

namespace App\Models\Apotek\Produk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukApotek extends Model
{
    use HasFactory;

    protected $table = "produk";

    protected $guarded = [''];

    public $primaryKey = "id_produk";

    protected $keyType = "string";

    public $incrementing = false;

    public function getOwnerApotek()
    {
        return $this->belongsTo("App\Models\Akun\OwnerApotek", "id_owner_apotek", "id_owner_apotek");
    }

    public function transaksiObat()
    {
        return $this->hasMany("App\Models\Master\Obat\TransaksiObat", "kode_produk", "kode_produk");
    }
}
