<?php

namespace App\Http\Resources\Master\RumahSakit\Spesialis;

use App\Http\Resources\Akun\Dokter\GetDokterResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GetDokterSpesialisResource extends JsonResource
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
            "id_praktek" => $this->id_praktek_ahli,
            "id_dokter" => $this->user->id,
            "nama_dokter" => $this->user->nama,
            "email" => $this->user->email,
            "nomor_hp" => $this->user->nomor_hp,
            "id_keahlian" => $this->getKeahlian,
            "id_spesialis" => $this->id_spesialis,
            "biaya" => "Rp. " . number_format($this->biaya_praktek),
            "tempat_medis" => $this->rumah_sakit->only("nama_rs", "alamat_rs", "foto_rs")
        ];
    }
}
