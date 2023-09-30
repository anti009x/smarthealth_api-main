<?php

namespace App\Models\Master\CekResi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CekResi extends Model
{
    protected $table = "cek_resi";

    protected $guarded = [""];

    public $primaryKey = "id_resi";

    protected $keyType = "string";

    public $incrementing = false;

    use HasFactory;
}
