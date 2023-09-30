<?php

namespace App\Http\Resources\Master\CekResi;

use Illuminate\Http\Resources\Json\JsonResource;

class GetResiResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            "id_resi" => $this->id_resi,
            "nama_jasa_pengiriman" => $this->nama_jasa_pengiriman,
            "kode_ekspedisi" => $this->kode_ekspedisi,
        ];
    }
}
