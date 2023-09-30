<?php

namespace App\Http\Resources\Master;

use Illuminate\Http\Resources\Json\JsonResource;

class AlamatUserResource extends JsonResource
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
            "id_alamat" => $this->id_alamat_user,
            "simpan_sebagai" => $this->simpan_sebagai,
            "lokasi" => $this->lokasi,
            "detail" => $this->detail
        ];
    }
}
