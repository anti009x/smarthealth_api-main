<?php

namespace App\Http\Resources\Transaksi;

use Illuminate\Http\Resources\Json\JsonResource;

class GetTransaksiProdukResource extends JsonResource
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
            "id_transaksi" => $this->id_transaksi,
            "konsumen" => [
                "nama" => $this->nama_konsumen,
                "nomor_hp" => $this->nomor_hp
            ],
            "pembayaran" => "Rp. " . number_format($this->pembayaran)
        ];
    }
}
