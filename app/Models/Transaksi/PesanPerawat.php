<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesanPerawat extends Model
{
    use HasFactory;

    protected $table = "pesan_perawat";

    protected $guarded = [''];

    public $primaryKey = "id_pesan_perawat";

    protected $keyType = "string";

    public $incrementing = false;

    public function konsumen()
    {
        return $this->belongsTo("App\Models\Akun\Konsumen", "konsumen_id", "id_konsumen");
    }
}
