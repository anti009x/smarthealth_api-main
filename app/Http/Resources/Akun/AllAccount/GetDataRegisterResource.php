<?php

namespace App\Http\Resources\Akun\AllAccount;

use Illuminate\Http\Resources\Json\JsonResource;

class GetDataRegisterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->getRole->id_role == "RO-2003062") {

            $file_dokumen = $this->getDokter->file_dokumen;

        } else if ($this->getRole->id_role == "RO-2003063") {

            $file_dokumen = $this->getPerawat->file_dokumen;

        } else if ($this->getRole->id_role == "RO-2003065") {

            $file_dokumen = $this->getApotek->file_dokumen;

        } else if ($this->getRole->id_role == "RO-2003066") {

            $file_dokumen = $this->getOwnerRs->file_dokumen;
            
        }
        return [
            "id" => $this->id,
            "nama" => $this->nama,
            "nomor_hp" => $this->nomor_hp,
            "alamat" => $this->alamat,
            "role" => $this->getRole->only("id_role", "nama_role"),
            "foto" => $this->foto,
            "file_dokumen" => $file_dokumen
        ];
    }
}
