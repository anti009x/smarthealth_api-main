<?php

namespace App\Http\Resources\Master\Ahli;

use Illuminate\Http\Resources\Json\JsonResource;

class GetDetailPraktekrResource extends JsonResource
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
            "id_detail_praktek" => $this->id_detail_praktek,
            "ahli" => $this->user,
            "rumah_sakit" => $this->rumah_sakit,
            "biaya_praktek" => $this->biaya_praktek
        ];
    }
}
