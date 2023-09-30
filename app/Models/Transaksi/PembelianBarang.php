<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianBarang extends Model
{
    use HasFactory;

    protected $table = "pembelian_barang";

    protected $guarded = [''];

    public $primaryKey = "id_pembelian_barang";

    protected $keyType = "string";

    public $incrementing = false;
}
