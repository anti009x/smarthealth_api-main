<?php

namespace App\Http\Resources\Akun\Apotek;

use Illuminate\Http\Resources\Json\JsonResource;

class GetOwnerApotekResource extends JsonResource
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
            "id_owner" => $this->id_owner_apotek,
            "get_user" => $this->getUser,
            "file_dokumen" => $this->file_dokumen
        ];
    }
}
