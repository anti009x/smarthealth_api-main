<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamatuser extends Model
{
    use HasFactory;

    protected $table = "alamat_user";

    protected $guarded = [''];

    public $primaryKey = "id_alamat_user";

    protected $keyType = "string";

    public $incrementing = false;
}
