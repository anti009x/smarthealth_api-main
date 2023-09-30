<?php

namespace App\Http\Resources\Transaksi;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class GetKeranjangDetailResource extends JsonResource
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
            "id_keranjang_detail" => $this->id_keranjang_detail,
            "detail" => [
                "id_keranjang" => $this->keranjang->id_keranjang,
                "konsumen" => [
                    "nama" => $this->keranjang->konsumen->getUsers->nama,
                    "nomor_hp" => $this->keranjang->konsumen->getUsers->nomor_hp
                ],
                "tanggal" => Carbon::createFromFormat('Y-m-d', $this->keranjang->tanggal)->isoFormat('D MMMM Y'),
                "jumlah_harga" => "Rp." . number_format($this->keranjang->jumlah_harga)
            ],
            "produk" => [
                "id_produk" => $this->produk->id_produk,
                "kode_produk" => $this->produk->kode_produk,
                "nama_produk" => $this->produk->nama_produk,
                "harga_produk" => "Rp." . number_format($this->produk->harga_produk)
            ],
            "qty" => $this->jumlah,
            "jumlah_harga" => "Rp." . number_format($this->jumlah_harga)
        ];
    }
}
