<?php

namespace App\Models\Master\Dokter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JadwalAntrian extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "jadwal_antrian";

    protected $guarded = [''];

    public $primaryKey = "id_jadwal_antrian";

    protected $keyType = "string";

    public $incrementing = false;

    public $timestamps = false;

    public function jadwal_praktek()
    {
        return $this->belongsTo("App\Models\Ahli\JadwalPraktek", "id_jadwal_praktek", "id_jadwal_praktek");
    }

    public function konsumen()
    {
        return $this->belongsTo("App\Models\Akun\Konsumen", "konsumen_id", "id_konsumen");
    }
}
