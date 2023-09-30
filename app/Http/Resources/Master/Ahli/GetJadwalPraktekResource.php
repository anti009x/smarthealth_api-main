<?php

namespace App\Http\Resources\Master\Ahli;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class GetJadwalPraktekResource extends JsonResource
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
            "id_jadwal_praktek" => $this->id_jadwal_praktek,
            "praktek" => [
                "dokter" => $this->detail_praktek->user->nama,
                "rumah_sakit" => $this->detail_praktek->rumah_sakit->nama_rs,
                "biaya" => $this->detail_praktek->biaya_praktek
            ],
            "hari" => Carbon::parse($this->hari)->isoFormat("dddd"),
            "tanggal" => Carbon::parse($this->tanggal)->isoFormat("dddd") . ", " . Carbon::createFromFormat('Y-m-d', $this->tanggal)->isoFormat('D MMMM Y'),
            "mulai_jam" => Carbon::createFromFormat("H:i:s", $this->mulai_jam)->format("H:i"),
            "selesai_jam" => Carbon::createFromFormat("H:i:s", $this->selesai_jam)->format("H:i")
        ];
    }
}
