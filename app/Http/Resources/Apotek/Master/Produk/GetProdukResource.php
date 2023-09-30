<?php

namespace App\Http\Resources\Apotek\Master\Produk;

use Illuminate\Http\Resources\Json\JsonResource;

class GetProdukResource extends JsonResource
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
            "id" => $this->id_produk,
            "kode_produk" => $this->kode_produk,
            "owner" => $this->getOwnerApotek->getUser->nama,
            "nama_produk" => $this->nama_produk,
            "slug_produk" => $this->slug_produk,
            "deskripsi_produk" => $this->deskripsi_produk,
            "harga_produk" => "Rp." . number_format($this->harga_produk),
            "foto_produk" => $this->foto_produk,
            "total_stok" => $this->qty
        ];
    }
}
