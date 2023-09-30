<?php

namespace App\Http\Resources\Akun\OwnerRs;

use Illuminate\Http\Resources\Json\JsonResource;

class GetOwnerRumahSakitResource extends JsonResource
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
            "id_owner" => $this->id_owner_rumah_sakit,
            "no_ktp" => $this->no_ktp,
            "user" => $this->getUser,
            "file_dokumen" => $this->file_dokumen
        ];
    }
}
