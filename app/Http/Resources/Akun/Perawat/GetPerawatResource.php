<?php

namespace App\Http\Resources\Akun\Perawat;

use Illuminate\Http\Resources\Json\JsonResource;

class GetPerawatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $jumlah = $this->ratings->sum('star');
        $rating = $this->ratings->count();
        $average = ($rating !== 0) ? ($jumlah / $rating) : 0;

        return [
            "id_perawat" => $this->id_perawat,
            "nomor_strp" => $this->nomor_strp,
            "user" => $this->getUser,
            "file_dokumen" => $this->file_dokumen,
            "rating" => $average
        ];
    }
}
