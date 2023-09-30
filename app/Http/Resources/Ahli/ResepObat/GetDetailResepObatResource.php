<?php

namespace App\Http\Resources\Ahli\ResepObat;

use Illuminate\Http\Resources\Json\JsonResource;

class GetDetailResepObatResource extends JsonResource
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
            "id_resep_obat_detail" => $this->id_resep_obat_detail,
            "resep_obat" => $this->resep_obat->only("id_resep_obat"),
            "produk" => [
                "id_produk" => $this->produk->id_produk,
                "kode_produk" => $this->produk->kode_produk,
                "nama_produk" => $this->produk->nama_produk,
                "harga_produk" => "Rp. " . number_format($this->produk->harga_produk)
            ],
            "qty" => $this->jumlah,
            "total" => $this->jumlah_harga,
            "convert" => "Rp. " . number_format($this->jumlah_harga)
        ];
    }
}
