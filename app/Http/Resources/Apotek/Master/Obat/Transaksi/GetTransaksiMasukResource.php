<?php

namespace App\Http\Resources\Apotek\Master\Obat\Transaksi;

use Illuminate\Http\Resources\Json\JsonResource;

class GetTransaksiMasukResource extends JsonResource
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
            "id_transaksi_obat" => $this->id_transaksi_obat,
            "get_obat" => $this->getObat->only("id_produk","kode_produk","nama_produk","harga_produk"),
            "tanggal" => $this->tanggal,
            "qty" => $this->qty,
            "nama_supplier" => $this->nama_supplier,
            "asal_supplier" => $this->asal_supplier,
            "status" => $this->status
        ];
    }
}
