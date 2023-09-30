<?php

namespace App\Models\Master\Ahli;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = "rating";

    protected $guarded = [''];

    public $primaryKey = "id_rating";

    protected $keyType = "string";

    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo("App\Models\User", "user_id", "id");
    }
}
