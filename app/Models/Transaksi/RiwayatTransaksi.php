<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatTransaksi extends Model
{
    use HasFactory;

    protected $table = "transaksi_buat_janji";

    protected $guarded = [''];

    public $primaryKey = "id_transaksi_buat_janji";

    protected $keyType = "string";

    public $incrementing = false;
}
