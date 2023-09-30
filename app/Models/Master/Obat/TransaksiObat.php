<?php

namespace App\Models\Master\Obat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiObat extends Model
{
    use HasFactory;

    protected $table = "transaksi_obat";

    protected $guarded = [''];

    public $primaryKey = "id_transaksi_obat";

    protected $keyType = "string";

    public $incrementing = false;

    public function getApotek()
    {
        return $this->belongsTo("App\Models\Akun\OwnerApotek", "apotek_id", "id_owner_apotek");
    }

    public function getObat()
    {
        return $this->belongsTo("App\Models\Apotek\Produk\ProdukApotek", "kode_produk", "kode_produk");
    }
}
