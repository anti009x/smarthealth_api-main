<?php

namespace App\Http\Resources\Master\Pengaturan\Profil;

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
            "id_profil" => $this->id_profil,
            "singkatan" => $this->singkatan,
            "nama_profil" => $this->nama_profil,
            "nomor_hp" => $this->nomor_hp,
            "alamat" => $this->alamat,
            "deskripsi_profil" => $this->deskripsi_profil,
            "foto" => $this->foto
        ];
    }
}
