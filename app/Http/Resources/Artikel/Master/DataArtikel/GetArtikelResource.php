<?php

namespace App\Http\Resources\Artikel\Master\DataArtikel;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class GetArtikelResource extends JsonResource
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
            "id_artikel" => $this->id_artikel,
            "judul_artikel" => $this->judul_artikel,
            "slug_artikel" => $this->slug_artikel,
            "foto" => $this->foto,
            "deskripsi" => $this->deskripsi,
            "get_user" => $this->getUser,
            "tanggal" => Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->isoFormat('D MMMM Y')
        ];
    }
}
