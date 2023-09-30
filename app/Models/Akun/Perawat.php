<?php

namespace App\Models\Akun;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perawat extends Model
{
    use HasFactory;

    protected $table = "perawat";

    protected $guarded = [''];

    public $primaryKey = "id_perawat";

    protected $keyType = "string";

    public $incrementing = false;

    public function getUser()
    {
        return $this->belongsTo("App\Models\User", "user_id", "id");
    }

    public function ratings()
    {
        return $this->hasMany("App\Models\Master\Ahli\Rating", "ahli_id", "user_id");
    }
}
