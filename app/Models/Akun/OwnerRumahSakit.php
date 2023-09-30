<?php

namespace App\Models\Akun;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerRumahSakit extends Model
{
    use HasFactory;

    protected $table = "owner_rumah_sakit";

    protected $guarded = [''];

    public $primaryKey = "id_owner_rumah_sakit";

    protected $keyType = "string";

    public $incrementing = false;

    public function getUser()
    {
        return $this->belongsTo("App\Models\User", "user_id", "id");
    }
}
