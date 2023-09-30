<?php

namespace App\Http\Resources\Transaksi;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class GetKeranjangResource extends JsonResource
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
            "id_keranjang" => $this->id_keranjang,
            "konsumen_id" => [
                "id_konsumen" => $this->konsumen_id,
                "detail" => $this->konsumen->getUsers->only("nama", "nomor_hp")
            ],
            "tanggal" => Carbon::createFromFormat('Y-m-d', $this->tanggal)->isoFormat('D MMMM Y'),
            "jumlah_harga" => "Rp." . number_format($this->jumlah_harga),
            "status" => $this->status
        ];
    }
}
