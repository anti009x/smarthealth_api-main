<?php

namespace App\Http\Resources\Akun\AllAccount;

use Illuminate\Http\Resources\Json\JsonResource;

class GetDataPraktekDokterResource extends JsonResource
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
            "id_praktek_ahli" => $this->id_praktek_ahli,
            "rumah_sakit" => $this->rumah_sakit->only("id_rumah_sakit", "nama_rs", "slug_rs"),
            "user" => $this->user->only("id", "nama", "nomor_hp", "jenis_kelamin", "status")
        ];
    }
}
