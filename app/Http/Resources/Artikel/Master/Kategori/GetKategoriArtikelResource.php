<?php

namespace App\Http\Resources\Artikel\Master\Kategori;

use Illuminate\Http\Resources\Json\JsonResource;

class GetKategoriArtikelResource extends JsonResource
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
            "id_kategori_artikel" => $this->id_kategori_artikel,
            "nama_kategori" => $this->nama_kategori
        ];
    }
}
