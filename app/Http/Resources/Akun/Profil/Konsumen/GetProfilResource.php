<?php

namespace App\Http\Resources\Akun\Profil\Konsumen;

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
            "id_konsumen" => $this->id_konsumen,
            "nik" => $this->nik,
            "user" => $this->getUsers
        ];
    }
}
