<?php

namespace App\Models\Artikel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupingArtikel extends Model
{
    use HasFactory;

    protected $table = "grouping_artikel";

    protected $guarded = [''];

    public $primaryKey = "id_grouping_artikel";

    protected $keyType = "string";

    public $incrementing = false;

    public function getArtikel()
    {
        return $this->belongsTo("App\Models\Artikel\DataArtikel", "id_artikel", "id_artikel");
    }

    public function getKategoriArtikel()
    {
        return $this->belongsTo("App\Models\Artikel\KategoriArtikel", "id_kategori_artikel", "id_kategori_artikel");
    }
}
