<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = "role";

    protected $guarded = [''];

    public $primaryKey = "id_role";

    protected $keyType = "string";

    public $incrementing = false;
}
