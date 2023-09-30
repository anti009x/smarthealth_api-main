<?php

namespace App\Models\Midtrans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $table = "bank";

    protected $guarded = [''];

    public $primaryKey = "id_bank";

    protected $keyType = "string";

    public $incrementing = false;
}
