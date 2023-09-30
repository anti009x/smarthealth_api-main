<?php

namespace App\Http\Resources\Transaksi;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class GetTransaksiRawatJalanResource extends JsonResource
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
            "id_pesan_perawat" => $this->id_pesan_perawat,
            "konsumen" => [
                "nama" => $this->konsumen->getUsers->nama,
                "nomor_hp" => $this->konsumen->getUsers->nomor_hp
            ],
            "alamat" => $this->alamat,
            "status" => $this->status,
            "created_at" => Carbon::createFromFormat("Y-m-d H:i:s", $this->created_at)->isoFormat("dddd, DD MMMM YYYY | HH:mm:ss")
        ];
    }
}
