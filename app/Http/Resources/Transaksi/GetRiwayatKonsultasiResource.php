<?php

namespace App\Http\Resources\Transaksi;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class GetRiwayatKonsultasiResource extends JsonResource
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
            "id_transaksi_konsultasi" => $this->id_transaksi_konsultasi,
            "konsumen" => [
                "id_konsumen" => $this->konsumen_id,
                "nama" => $this->nama,
                "nomor_hp" => $this->nomor_hp
            ],
            "ahli" => [
                "id_ahli" => $this->ahli_id,
                "nama" => $this->nama_ahli,
                "nomor_hp" => $this->nomor_hp_ahli
            ],
            "transaksi" => [
                "biaya" => "Rp. " . number_format($this->biaya_konsultasi),
                "status" => "Sudah Konsultasi",
                "tanggal" => Carbon::createFromFormat("Y-m-d H:i:s", $this->created_at)->isoFormat("dddd, DD MMMM YYYY | HH:mm:ss")
            ]
        ];
    }
}
