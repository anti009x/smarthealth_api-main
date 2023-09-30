<?php

namespace App\Models\Akun;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RumahSakit extends Model
{
    use HasFactory;

    protected $table = "rumah_sakit";

    protected $guarded = [''];

    public $primaryKey = "id_rumah_sakit";

    protected $keyType = "string";

    public $incrementing = false;

    public function getOwnerRumahSakit()
    {
        return $this->belongsTo("App\Models\Akun\OwnerRumahSakit", "id_owner_rumah_sakit", "id_owner_rumah_sakit");
    }
}
