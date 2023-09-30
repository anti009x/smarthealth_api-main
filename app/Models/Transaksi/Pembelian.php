<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = "pembelian";

    protected $guarded = [''];

    public $primaryKey = "id_pembelian";

    protected $keyType = "string";

    public $incrementing = false;

    public function konsumen()
    {
        return $this->belongsTo("App\Models\Akun\Konsumen", "konsumen_id", "id_konsumen");
    }

    public function invoice()
    {
        return $this->hasOne("App\Models\Midtrans\Invoice", "id_jenis_transaksi", "id_pembelian");
    }
}
