<?php

namespace App\Http\Resources\Ahli\Antrian;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class GetAntrianResource extends JsonResource
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
            "id_jadwal_antrian" => $this->id_jadwal_antrian,
            "konsumen" => [
                "id_konsumen" => $this->konsumen->id_konsumen,
                "user" => $this->konsumen->getUsers->only("nama", "nomor_hp"),
                "nik" => $this->konsumen->nik
            ],
            "praktek" => [
                "jadwal" => [
                    "tanggal" => Carbon::parse($this->jadwal_praktek->tanggal)->translatedFormat("l, d F Y"),
                    "detail" => $this->jadwal_praktek->only("mulai_jam", "selesai_jam")
                ],
                "ahli" => [
                    "id_detail_praktek" => $this->jadwal_praktek->detail_praktek->id_detail_praktek,
                    "user" => $this->jadwal_praktek->detail_praktek->user->only("nama", "nomor_hp"),
                    "biaya" => "Rp. " . number_format($this->jadwal_praktek->detail_praktek->biaya_praktek)
                ]
            ],
            "qr" => $this->qr_code,
            "status" => $this->status,
            "tanggal_antrian" => Carbon::parse($this->tanggal)->translatedFormat('l, d F Y'),
            "delete" => empty($this->deleted_at) ? "false" : "true"
        ];
    }
}
