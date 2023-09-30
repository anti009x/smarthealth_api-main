<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResepObat extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "resep_obat";

    protected $guarded = [''];

    public $primaryKey = "id_resep_obat";

    protected $keyType = "string";

    public $incrementing = false;

    public function users()
    {
        return $this->belongsTo("App\Models\User", "ahli_id", "id");
    }

    public function konsumen()
    {
        return $this->belongsTo("App\Models\Akun\Konsumen", "konsumen_id", "id_konsumen");
    }
}
