<?php

namespace App\Models\Akun;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    use HasFactory;

    protected $table = "reset_password";

    protected $guarded = [''];

    public $primaryKey = "id_reset_password";

    protected $keyType = "string";

    public $incrementing = false;
}
