<?php

namespace App\Http\Resources\Master\Dokter;

use Illuminate\Http\Resources\Json\JsonResource;

class BiayaDokterResource extends JsonResource
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
            "get_biaya" => $this->biaya
        ];
    }
}
