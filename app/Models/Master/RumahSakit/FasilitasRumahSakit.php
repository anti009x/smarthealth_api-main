<?php

namespace App\Models\Master\RumahSakit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FasilitasRumahSakit extends Model
{
    use HasFactory;

    protected $table = "fasilitas_rumah_sakit";

    protected $guarded = [''];

    public $primaryKey = "id_fasilitas_rumah_sakit";

    protected $keyType = "string";

    public $incrementing = false;

    public function getRumahSakit()
    {
        return $this->belongsTo("App\Models\Akun\RumahSakit", "id_rumah_sakit", "id_rumah_sakit");
    }
}
