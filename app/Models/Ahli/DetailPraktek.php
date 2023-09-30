<?php

namespace App\Models\Ahli;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPraktek extends Model
{
    use HasFactory;

    protected $table = "detail_praktek";

    protected $guarded = [''];

    public $primaryKey = "id_detail_praktek";

    protected $keyType = "string";

    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo("App\Models\User", "ahli_id", "id");
    }

    public function rumah_sakit()
    {
        return $this->belongsTo("App\Models\Akun\RumahSakit", "id_rumah_sakit", "id_rumah_sakit");
    }

    public function jadwal_praktek()
    {
        return $this->hasMany("App\Models\JadwalPraktek", "id_detail_praktek", "id_detail_praktek");
    }
}
