<?php

namespace App\Http\Resources\Master\Keahlian;

use Illuminate\Http\Resources\Json\JsonResource;

class GetDokterKeahlianResource extends JsonResource
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
            "id_dokter_keahlian" => $this->id_dokter_keahlian,
            "get_dokter" => $this->getDokter,
            "get_keahlian" => $this->getKeahlian
        ];
    }
}
