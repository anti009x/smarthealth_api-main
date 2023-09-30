<?php

namespace App\Http\Resources\Master\Produk\KategoriProduk;

use Illuminate\Http\Resources\Json\JsonResource;

class GetKategoriResource extends JsonResource
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
            "id_kategori_produk" => $this->id_kategori_produk,
            "nama_kategori_produk" => $this->nama_kategori_produk,
            "slug_kategori_produk" => $this->slug_kategori_produk
        ];
    }
}
