<?php

namespace App\Http\Resources\Artikel\Master\GroupingArtikel;

use Illuminate\Http\Resources\Json\JsonResource;

class GetGroupingArtikelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http \Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id_grouping_artikel" => $this->id_grouping_artikel,
            "judul_artikel" => $this->getArtikel->judul_artikel,
            "deskripsi" => $this->getArtikel->deskripsi,
            "foto" => $this->getArtikel->foto,
            "id_artikel" => $this->getArtikel->id_artikel,
            "id_grouping_artikel" => $this->id_grouping_artikel,
            "nama_kategori" => $this->getKategoriArtikel->nama_kategori
        ];
    }
}
