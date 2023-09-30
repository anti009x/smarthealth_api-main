<?php

namespace App\Http\Resources\Master\Keahlian;

use Illuminate\Http\Resources\Json\JsonResource;

class GetKeahlianResource extends JsonResource
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
            "id_keahlian" => $this->id_keahlian,
            "nama_keahlian" => $this->nama_keahlian,
            "logo" => $this->logo,
            "id_spesialis_penyakit" => $this->id_spesialis_penyakit
        ];
    }
}
