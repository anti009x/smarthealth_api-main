<?php

namespace App\Models\Master\RajaOngkir;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;

    protected $table = "kota";

    protected $guarded = [''];

    public function getProvinsi()
    {
        return $this->belongsTo("App\Models\Master\RajaOngkir\Provinsi", "province_id", "province_id");
    }
}
