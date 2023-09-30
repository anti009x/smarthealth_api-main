<?php

namespace App\Models\Ahli;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiayaPraktek extends Model
{
    use HasFactory;

    protected $table = "biaya_praktek";

    protected $guarded = [''];

    public $primaryKey = "id_biaya_praktek";

    protected $keyType = "string";

    public $incrementing = false;
}
