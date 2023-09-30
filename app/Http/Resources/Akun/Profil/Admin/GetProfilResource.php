<?php

namespace App\Http\Resources\Akun\Profil\Admin;

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
            "id"            => $this->id,
            "nama"          => $this->nama,
            "email"         => $this->email,
            "nomor_hp"      => $this->nomor_hp,
            "alamat"        => $this->alamat,
            "jenis_kelamin" => $this->jenis_kelamin,
            "usia"          => $this->usia,
            "berat_badan"   => $this->berat_badan,
            "tinggi_badan"  => $this->tinggi_badan,
            "tempat_lahir"  => $this->tempat_lahir,
            "tanggal_lahir" => $this->tanggal_lahir,
            "foto"          => $this->foto
        ];
    }
}
