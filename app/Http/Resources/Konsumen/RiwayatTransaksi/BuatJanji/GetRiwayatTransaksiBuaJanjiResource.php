<?php

namespace App\Http\Resources\Konsumen\RiwayatTransaksi\BuatJanji;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class GetRiwayatTransaksiBuaJanjiResource extends JsonResource
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
            "id_transaksi_buat_janji" => $this->id_transaksi_buat_janji,
            "konsumen" => [
                "nama" => $this->nama,
                "nomor_hp" => $this->nomor_hp
            ],
            "ahli" => [
                "nama" => $this->nama_ahli,
                "nomor_hp" => $this->nomor_hp_ahli,
                "foto" => $this->foto_ahli
            ],
            "detail" => [
                "biaya" => "Rp." . number_format($this->biaya_praktek),
                "nama_rs" => $this->nama_rs
            ],
            "tanggal_transaksi" => Carbon::parse($this->tanggal_transaksi)->translatedFormat('l, d F Y'),
            "status" => $this->status
        ];
    }
}
