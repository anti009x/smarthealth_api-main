<?php

namespace App\Http\Resources\Akun\Profil\Apotek;

use Illuminate\Http\Resources\Json\JsonResource;

class GetProfilResource extends JsonResource
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
            "id_owner_apotek" => $this->id_owner_apotek,
            "user" => $this->getUser
        ];
    }
}
