<?php

namespace App\Http\Resources\Master\RumahSakit\Spesialis;

use Illuminate\Http\Resources\Json\JsonResource;

class GetSpesialisResource extends JsonResource
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
            "id_spesialis" => $this->id_spesialis,
            "id_rumah_sakit" => $this->id_rumah_sakit,
            "penyakit" => $this->getSpesialisPenyakit
        ];
    }
}
