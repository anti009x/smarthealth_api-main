<?php

namespace App\Models\Master\Pengaturan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;

    protected $table = "profil";

    protected $guarded = [''];

    public $primaryKey = "id_profil";

    protected $keyType = "string";

    public $incrementing = false;
}
