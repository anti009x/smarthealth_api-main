<?php

namespace App\Http\Resources\Master\Ahli;

use Illuminate\Http\Resources\Json\JsonResource;

class GetPraktekAhliResource extends JsonResource
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
            "id_praktek_ahli" => $this->id_praktek_ahli,
            "ahli" => $this->ahli_id,
            "id_keahlian" => $this->id_keahlian,
            "id_spesialis" => $this->id_spesialis,
            "id_rumah_sakit" => $this->rumah_sakit,
        ];
    }
}
