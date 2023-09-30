<?php

namespace App\Models\Master\Penyakit;

use App\Models\Ahli\Keahlian;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpesialisPenyakit extends Model
{
    use HasFactory;

    protected $table = "spesialis_penyakit";

    protected $guarded = [''];

    public $primaryKey = "id_spesialis_penyakit";

    protected $keyType = "string";

    public $incrementing = false;

    public function keahlian()
    {
        return $this->hasMany(Keahlian::class, "id_spesialis_penyakit");
    }

}
