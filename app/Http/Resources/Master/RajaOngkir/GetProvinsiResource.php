<?php

namespace App\Http\Resources\Master\RajaOngkir;

use Illuminate\Http\Resources\Json\JsonResource;

class GetProvinsiResource extends JsonResource
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
            "id_provinsi" => $this->province_id,
            "provinsi" => $this->title
        ];
    }
}
