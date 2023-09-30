<?php

namespace App\Http\Resources\Master\RumahSakit\Fasilitas;

use Illuminate\Http\Resources\Json\JsonResource;

class GetFasilitasResource extends JsonResource
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
            "id_fasilitas" => $this->id_fasilitas,
            "rumah_sakit" => $this->getRumahSakit,
            "nama_fasilitas" => $this->nama_fasilitas
        ];
    }
}
