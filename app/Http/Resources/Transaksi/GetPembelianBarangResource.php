<?php

namespace App\Http\Resources\Transaksi;

use Illuminate\Http\Resources\Json\JsonResource;

class GetPembelianBarangResource extends JsonResource
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
            "id_pembelian_barang" => $this->id_pembelian_barang,
            "id_pembelian" => $this->id_pembelian,
            "produk" => [
                "kode_produk" => $this->kode_produk,
                "nama_produk" => $this->nama_barang,
                "harga" => "Rp. " . number_format($this->harga)
            ],
            "qty" => $this->jumlah
        ];
    }
}
