<?php

namespace App\Models\Artikel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataArtikel extends Model
{
    use HasFactory;

    protected $table = "artikel";

    protected $guarded = [''];

    public $primaryKey = "id_artikel";

    protected $keyType = "string";

    public $incrementing = false;

    public function getUser()
    {
        return $this->belongsTo("App\Models\User", "user_id", "id");
    }
}
