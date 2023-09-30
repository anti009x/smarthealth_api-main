<?php

namespace App\Models\Ahli;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPraktek extends Model
{
    use HasFactory;

    protected $table = "jadwal_praktek";

    protected $guarded = [''];

    public $primaryKey = "id_jadwal_praktek";

    protected $keyType = "string";

    public $incrementing = false;

    public $timestamps = false;

    public function detail_praktek()
    {
        return $this->belongsTo("App\Models\Ahli\DetailPraktek", "id_detail_praktek", "id_detail_praktek");
    }

    public function hamdan()
    {
        return $this->belongsTo("App\Models\Ahli\DetailPraktek", "id_detail_praktek", "id_detail_praktek");
    }
}
