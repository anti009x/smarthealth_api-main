<?php

namespace App\Models\Ahli;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PraktekAhli extends Model
{
    use HasFactory;

    protected $table = "praktek_ahli";
    
    protected $guarded = [''];

    public $primaryKey = "id_praktek_ahli";

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

    public function getKeahlian()
    {
        return $this->belongsTo("App\Models\Ahli\Keahlian", "id_keahlian", "id_keahlian");
    }
}
