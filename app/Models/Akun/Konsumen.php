<?php

namespace App\Models\Akun;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    use HasFactory;

    protected $table = "konsumen";

    protected $guarded = [''];

    public $primaryKey = "id_konsumen";

    protected $keyType = "string";

    public $incrementing = false;

    public function getUsers()
    {
        return $this->belongsTo("App\Models\User", "user_id", "id");
    }
}
