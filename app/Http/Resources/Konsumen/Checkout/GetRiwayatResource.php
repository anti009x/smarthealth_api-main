<?php

namespace App\Http\Resources\Konsumen\Checkout;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class GetRiwayatResource extends JsonResource
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
            "id_pembelian" => $this->id_pembelian,
            "konsumen" => [
                "id_konsumen" => $this->konsumen_id,
                "detail" => $this->konsumen->getUsers->only("nama", "nomor_hp")
            ],
            "tanggal_pembelian" => Carbon::createFromFormat("Y-m-d H:i:s", $this->tanggal_pembelian)->isoFormat("dddd, DD MMMM YYYY | HH:mm:ss"),
            "total_pembelian" => $this->total_pembelian,
            "alamat_pengiriman" => $this->alamat_pengiriman,
            "status_pembelian" => $this->status_pembelian
        ];
    }
}
