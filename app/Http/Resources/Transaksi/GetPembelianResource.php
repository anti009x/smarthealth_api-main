<?php

namespace App\Http\Resources\Transaksi;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class GetPembelianResource extends JsonResource
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
            "id_pembelian" => $this["id_pembelian"],
            "konsumen_id" => [
                "id_konsumen" => $this->konsumen_id,
                "detail" => $this->konsumen->getUsers->only("nama", "nomor_hp")
            ],
            "tanggal_pembelian" => Carbon::createFromFormat("Y-m-d H:i:s", $this->tanggal_pembelian)->isoFormat("dddd, DD MMMM YYYY | HH:mm:ss"),
            "total_pembelian" => "Rp. " . number_format($this->total_pembelian),
            "ongkir" => [
                "nama_kota" => $this->nama_kota,
                "alamat_pengiriman" => $this->alamat_pengiriman,
            ],
            "tarif" => "Rp. " . number_format($this->tarif),
            "status" => $this->status_pembelian,
            "resi_pengiriman" => $this->resi_pengiriman,
            "notification" => $this->invoice->only("invoice", "transaction_id", "status")
        ];
    }
}
