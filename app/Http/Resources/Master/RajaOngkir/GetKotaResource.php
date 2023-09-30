<?php

namespace App\Http\Resources\Master\RajaOngkir;

use Illuminate\Http\Resources\Json\JsonResource;

class GetKotaResource extends JsonResource
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
            "provinsi" => $this->getProvinsi->title,
            "id_kota" => $this->city_id,
            "nama_kota" => $this->title,
        ];
    }
}
