<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = "pembayaran";

    protected $guarded = [''];

    public $primaryKey = "id_pembayaran";

    protected $keyType = "string";

    public $incrementing = false;
}
