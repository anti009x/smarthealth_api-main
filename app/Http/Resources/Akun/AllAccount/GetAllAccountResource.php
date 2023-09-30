<?php

namespace App\Http\Resources\Akun\AllAccount;

use Illuminate\Http\Resources\Json\JsonResource;

class GetAllAccountResource extends JsonResource
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
            "id" => $this->id,
            "nama" => $this->nama,
            "email" => $this->email,
            "nomor_hp" => $this->nomor_hp,
            "get_role" => $this->getRole
        ];
    }
}
