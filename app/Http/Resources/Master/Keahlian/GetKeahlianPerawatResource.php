<?php

namespace App\Http\Resources\Master\Keahlian;

use Illuminate\Http\Resources\Json\JsonResource;

class GetKeahlianPerawatResource extends JsonResource
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
            "id_perawat_keahlian" => $this->id_perawat_keahlian,
            "perawat" => $this->perawat,
            "keahlian" => $this->keahlian
        ];
    }
}
