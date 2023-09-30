<?php

namespace App\Models\Artikel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriArtikel extends Model
{
    use HasFactory;

    protected $table = "kategori_artikel";

    protected $guarded = [''];

    public $primaryKey = "id_kategori_artikel";

    protected $keyType = "string";

    public $incrementing = false;
}
