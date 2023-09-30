<?php

namespace App\Http\Resources\Akun\Konsumen;

use Illuminate\Http\Resources\Json\JsonResource;

class GetKonsumenResource extends JsonResource
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
            "user" => $this->getUsers,
            "nik" => $this->nik
        ];
    }
}
