<?php

namespace App\Http\Resources\Master\RumahSakit\RS;

use Illuminate\Http\Resources\Json\JsonResource;

class GetRumahSakitResource extends JsonResource
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
            "id_rumah_sakit" => $this->id_rumah_sakit,
            "pemilik" => $this->getOwnerRumahSakit->getUser->nama,
            "nama_rs" => $this->nama_rs,
            "slug_rs" => $this->slug_rs,
            "deskripsi_rs" => $this->deskripsi_rs,
            "kategori_rs" => $this->kategori_rs,
            "alamat_rs" => $this->alamat_rs,
            "latitude" => $this->latitude,
            "longitude" => $this->longitude,
            "foto" => $this->foto_rs
        ];
    }
}
