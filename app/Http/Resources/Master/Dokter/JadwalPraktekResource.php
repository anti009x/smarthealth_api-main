<?php

namespace App\Http\Resources\Master\Dokter;

use Illuminate\Http\Resources\Json\JsonResource;

class JadwalPraktekResource extends JsonResource
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
            "id_jadwal_praktek_dokter" => $this->id_jadwal_praktek_dokter,
            "dokter" => $this->praktek->dokter->getUser->nama,
            "rumah_sakit" => $this->praktek->rumah_sakit->nama_rs,
            "hari" => $this->hari,
            "mulai_jam" => $this->mulai_jam,
            "selesai_jam" => $this->selesai_jam
        ];
    }
}
