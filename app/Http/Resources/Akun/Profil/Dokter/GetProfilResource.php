<?php

namespace App\Http\Resources\Akun\Profil\Dokter;

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
            "nomor_str" => $this->nomor_str,
            "kelas" => $this->kelas,
            "user" => $this->getUser,
            "biaya" => empty($this->getBiaya->biaya) ? 0 : $this->getBiaya->biaya,
            "is_online" => $this->is_online
        ];
    }
}
