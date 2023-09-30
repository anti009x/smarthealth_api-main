<?php

namespace App\Http\Resources\Master\Ahli;

use Illuminate\Http\Resources\Json\JsonResource;

class GetMasterKeahlianResource extends JsonResource
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
            "id_master" => $this->id_master_join_keahlian,
            "user" => $this->user,
            "keahlian_id" => $this->keahlian
        ];
    }
}
