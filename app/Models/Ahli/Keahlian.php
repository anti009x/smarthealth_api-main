<?php

namespace App\Models\Ahli;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keahlian extends Model
{
    use HasFactory;

    protected $table = "keahlian";

    protected $guarded = [''];

    public $primaryKey = "id_keahlian";

    protected $keyType = "string";

    public $incrementing = false;

    public function master_keahlian()
    {
        return $this->hasMany("App\Models\Ahli\MasterJoinKeahlian", "keahlian_id", "id_keahlian");
    }
}
