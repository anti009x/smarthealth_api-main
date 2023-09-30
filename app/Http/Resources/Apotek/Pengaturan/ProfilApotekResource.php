<?php

namespace App\Http\Resources\Apotek\Pengaturan;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfilApotekResource extends JsonResource
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
            "id_profil_apotek" => $this->id_profil_apotek,
            "nama_apotek" => $this->nama_apotek,
            "slug_apotek" => $this->slug_apotek,
            "deskripsi_apotek" => $this->deskripsi_apotek,
            "alamat_apotek" => $this->alamat_apotek,
            "nomor_hp" => $this->nomor_hp,
            "foto_apotek" => $this->foto_apotek,
            "status" => $this->status,
            "user" => $this->getUser,
            "latitude" => $this->latitude,
            "longitude" => $this->longitude
        ];
    }
}
