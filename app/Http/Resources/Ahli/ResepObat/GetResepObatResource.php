<?php

namespace App\Http\Resources\Ahli\ResepObat;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class GetResepObatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id_resep_obat" => $this->id_resep_obat,
            "ahli" => [
                "nama" => $this->users->nama,
                "nomor_hp" => $this->users->nomor_hp  
            ],
            "konsumen" => [
                "nama" => $this->konsumen->getUsers->nama,
                "nomor_hp" => $this->konsumen->getUsers->nomor_hp
            ],
            "tanggal" => Carbon::createFromFormat('Y-m-d H:i:s', $this->tanggal)->isoFormat('D MMMM Y'),
            "jumlah_harga" => "Rp. " . number_format($this->jumlah_harga),
            "status" => $this->status,
            "delete" => $this->deleted_at
        ];
    }
}
